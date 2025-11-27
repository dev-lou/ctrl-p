<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class InventoryProductController extends Controller
{
    /**
     * Display the inventory product listing page.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request): \Illuminate\View\View
    {
        // eager-load only the columns we need from variants to reduce payload
        $query = Product::with(['variants:id,product_id,stock_quantity,price_modifier']);

        // Apply search filter by product name
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        // Apply status filter
        if ($request->filled('status') && $request->input('status') !== 'all') {
            $status = $request->input('status');
            $query->where('status', $status);
        }

        // Apply stock level filter
        if ($request->filled('stock_level')) {
            $stockLevel = $request->input('stock_level');
            if ($stockLevel === 'low') {
                $query->where(function($q) {
                    $q->whereRaw('current_stock <= low_stock_threshold')
                      ->orWhereHas('variants', function($vq) {
                          $vq->whereRaw('stock_quantity <= 20');
                      });
                });
            } elseif ($stockLevel === 'out') {
                $query->where(function($q) {
                    $q->where('current_stock', 0)
                      ->orWhereDoesntHave('variants')
                      ->orWhereHas('variants', function($vq) {
                          $vq->havingRaw('SUM(stock_quantity) = 0');
                      });
                });
            } elseif ($stockLevel === 'in_stock') {
                $query->where(function($q) {
                    $q->where('current_stock', '>', 0)
                      ->orWhereHas('variants', function($vq) {
                          $vq->where('stock_quantity', '>', 0);
                      });
                });
            }
        }

        // Apply price range filter
        if ($request->filled('min_price')) {
            $query->where('base_price', '>=', $request->input('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('base_price', '<=', $request->input('max_price'));
        }

        // Apply sorting
        $sortBy = $request->input('sort_by', 'name');
        $sortOrder = $request->input('sort_order', 'asc');
        
        if ($sortBy === 'price') {
            $query->orderBy('base_price', $sortOrder);
        } elseif ($sortBy === 'stock') {
            $query->orderBy('current_stock', $sortOrder);
        } elseif ($sortBy === 'created_at') {
            $query->orderBy('created_at', $sortOrder);
        } else {
            $query->orderBy('name', $sortOrder);
        }

        // Use simplePaginate to avoid expensive total count queries on large datasets
        $products = $query->simplePaginate(20);

        // Calculate statistics using DB queries (avoid loading all rows into memory)
        $totalProducts = Product::count();
        $activeProducts = Product::where('status', 'active')->count();
        $inactiveProducts = Product::where('status', 'inactive')->count();

        // low stock: product current_stock <= low_stock_threshold OR any variant with stock_quantity <= 20
        $lowStockCount = Product::whereRaw('current_stock <= low_stock_threshold')
            ->orWhereHas('variants', function ($q) {
                $q->where('stock_quantity', '<=', 20);
            })
            ->count();

        // total inventory value: sum product base_price * current_stock + contribution from variants
        $productValue = Product::sum(DB::raw('COALESCE(base_price * current_stock, 0)'));
        $variantValue = DB::table('product_variants')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->selectRaw('SUM((products.base_price + COALESCE(product_variants.price_modifier,0)) * product_variants.stock_quantity) AS total')
            ->value('total') ?: 0;

        $totalStock = Product::sum('current_stock') + DB::table('product_variants')->sum('stock_quantity');

        $stats = [
            'total_products' => (int) $totalProducts,
            'active_products' => (int) $activeProducts,
            'inactive_products' => (int) $inactiveProducts,
            'low_stock_count' => (int) $lowStockCount,
            'total_inventory_value' => (float) ($productValue + $variantValue),
            'total_stock' => (int) $totalStock,
        ];

        return view('admin.inventory.index', [
            'products' => $products,
            'stats' => $stats,
        ]);
    }

    /**
     * Display the create product form.
     *
     * @return \Illuminate\View\View
     */
    public function create(): \Illuminate\View\View
    {
        return view('admin.inventory.create');
    }

    /**
     * Store a new product in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            // Log incoming request data for debugging
            \Log::info('Product Store Request', [
                'has_image' => $request->hasFile('image'),
                'image_file' => $request->file('image') ? $request->file('image')->getClientOriginalName() : null,
                'all_data' => $request->except(['image']),
            ]);

            // Validate product input
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'slug' => 'required|string|unique:products,slug|max:255',
                'description' => 'nullable|string',
                'base_price' => 'required|numeric|min:0',
                'status' => 'required|in:active,inactive',
                'image' => 'nullable|image|mimes:jpeg,png,gif,webp|max:5120', // 5MB max
                'variants' => 'required|array|min:1',
                'variants.*.name' => 'required|string|max:255',
                'variants.*.stock_quantity' => 'required|integer|min:0',
                'variants.*.price_modifier' => 'nullable|numeric|min:0',
            ]);

        // Handle image upload to Supabase Storage
        $imagePath = null;
        if ($request->hasFile('image')) {
            try {
                $file = $request->file('image');
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                $storagePath = $filename;  // Store directly in bucket root since bucket is already 'products'

                \Log::info('Attempting Supabase upload', [
                    'filename' => $filename,
                    'storage_path' => $storagePath,
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'disk' => 'supabase',
                    'endpoint' => env('AWS_ENDPOINT'),
                    'bucket' => env('AWS_BUCKET'),
                    'aws_key' => env('AWS_ACCESS_KEY_ID') ? substr(env('AWS_ACCESS_KEY_ID'), 0, 8) . '...' : 'NOT SET',
                    'aws_url' => env('AWS_URL'),
                ]);

                // Upload to Supabase Storage using the 'supabase' disk
                $disk = Storage::disk('supabase');
                $uploaded = $disk->put($storagePath, file_get_contents($file), 'public');
                
                // Verify the file was actually uploaded (wrap in try-catch since exists() can throw with throw:true)
                $fileExists = false;
                try {
                    $fileExists = $disk->exists($storagePath);
                } catch (\Exception $existsError) {
                    \Log::warning('Could not verify file exists on Supabase', ['error' => $existsError->getMessage()]);
                }
                
                \Log::info('Upload result', [
                    'put_returned' => $uploaded,
                    'file_exists_check' => $fileExists,
                ]);

                if ($uploaded) {
                    // Build the public URL for the uploaded image
                    // Format: https://<project-ref>.supabase.co/storage/v1/object/public/<bucket>/<path>
                    $imagePath = env('AWS_URL') . '/' . $storagePath;

                    \Log::info('Image uploaded to Supabase successfully', [
                        'storage_path' => $storagePath,
                        'public_url' => $imagePath,
                    ]);
                } else {
                    \Log::warning('Supabase upload failed verification', [
                        'put_returned' => $uploaded,
                        'file_exists' => $fileExists,
                    ]);
                    // Fallback to local storage
                    $localPath = $file->store('products', 'public');
                    $imagePath = '/storage/' . $localPath;
                    \Log::info('Image saved to local storage as fallback', ['path' => $imagePath]);
                    
                    // Add warning for admin
                    session()->flash('warning', 'Image saved locally (Supabase upload failed). Images may be lost on redeploy.');
                }
            } catch (\Exception $e) {
                \Log::error('Supabase image upload failed', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                
                // Try local storage as fallback
                try {
                    $localPath = $request->file('image')->store('products', 'public');
                    $imagePath = '/storage/' . $localPath;
                    \Log::info('Image saved to local storage as fallback after Supabase error', ['path' => $imagePath]);
                    
                    // Add warning for admin with error details
                    session()->flash('warning', 'Supabase error: ' . $e->getMessage() . '. Image saved locally (may be lost on redeploy).');
                } catch (\Exception $localError) {
                    \Log::error('Local storage fallback also failed', ['error' => $localError->getMessage()]);
                    $imagePath = null;
                }
            }
        }

        // Calculate total stock from variants
        $totalStock = collect($validated['variants'])->sum('stock_quantity');

        // Add image path (public URL) and calculated stock to validated data
        $validated['image_path'] = $imagePath;
        $validated['current_stock'] = $totalStock;
        $validated['low_stock_threshold'] = 20; // Default threshold

        \Log::info('Creating product', $validated);

        // Create the product
        $product = Product::create($validated);

        // Create variants
        foreach ($validated['variants'] as $variantData) {
            $product->variants()->create([
                'name' => $variantData['name'],
                'stock_quantity' => $variantData['stock_quantity'],
                'price_modifier' => $variantData['price_modifier'] ?? 0,
                'status' => $validated['status'],
            ]);
        }

        return redirect()->route('admin.inventory.index')
            ->with('success', 'Product created successfully with ' . count($validated['variants']) . ' variant(s)!');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e; // Let validation errors bubble up normally
        } catch (\Exception $e) {
            \Log::error('Product store failed', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create product: ' . $e->getMessage());
        }
    }

    /**
     * Display the edit product form.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product): \Illuminate\View\View
    {
        $product->load('variants');
        
        // Calculate total stock from variants
        $totalStock = $product->variants()->sum('stock_quantity');
        $activeVariantsCount = $product->variants()->where('status', 'active')->count();
        
        return view('admin.inventory.edit', [
            'product' => $product,
            'totalStock' => $totalStock,
            'activeVariantsCount' => $activeVariantsCount,
        ]);
    }

    /**
     * Update a product in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product): \Illuminate\Http\RedirectResponse
    {
        try {
        \Log::info('Update method called for product', ['product_id' => $product->id, 'product_name' => $product->name]);
        \Log::info('Request data', ['all_data' => $request->all()]);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
            'current_stock' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,gif,webp|max:5120', // 5MB max
            'variants' => 'nullable|array',
            'variants.*.id' => 'required_with:variants|exists:product_variants,id',
            'variants.*.name' => 'nullable|string|max:255',
            'variants.*.stock_quantity' => 'required_with:variants|integer|min:0',
            'variants.*.price_modifier' => 'nullable|numeric|min:0',
            'variants.*.size' => 'nullable|string|max:255',
            'variants.*.color' => 'nullable|string|max:255',
            'variants.*.weight' => 'nullable|string|max:255',
            'variants.*.delete' => 'nullable|in:0,1',
            'new_variants' => 'nullable|array',
            'new_variants.*.name' => 'required_with:new_variants|string|max:255',
            'new_variants.*.stock_quantity' => 'required_with:new_variants|integer|min:0',
            'new_variants.*.price_modifier' => 'nullable|numeric|min:0',
            'new_variants.*.size' => 'nullable|string|max:255',
            'new_variants.*.color' => 'nullable|string|max:255',
            'new_variants.*.weight' => 'nullable|string|max:255',
        ]);

        \Log::info('Validation passed', ['validated_data' => $validated]);

        // Handle image upload to Supabase Storage
        if ($request->hasFile('image')) {
            try {
                // Delete old image from Supabase if it exists
                if ($product->image_path) {
                    $this->deleteSupabaseImage($product->image_path);
                }

                // Upload new image to Supabase Storage
                $file = $request->file('image');
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                $storagePath = $filename;  // Store directly in bucket root since bucket is already 'products'

                \Log::info('Attempting Supabase upload for update', [
                    'filename' => $filename,
                    'storage_path' => $storagePath,
                    'file_size' => $file->getSize(),
                    'disk' => 'supabase',
                ]);

                $uploaded = Storage::disk('supabase')->put($storagePath, file_get_contents($file), 'public');

                if ($uploaded) {
                    // Build the public URL for the uploaded image
                    $validated['image_path'] = env('AWS_URL') . '/' . $storagePath;

                    \Log::info('Product image updated on Supabase', [
                        'storage_path' => $storagePath,
                        'public_url' => $validated['image_path'],
                    ]);
                } else {
                    \Log::warning('Supabase upload returned false during update, trying local fallback');
                    $localPath = $file->store('products', 'public');
                    $validated['image_path'] = '/storage/' . $localPath;
                }
            } catch (\Exception $e) {
                \Log::error('Supabase image upload failed during update', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                
                // Try local storage as fallback
                try {
                    $localPath = $request->file('image')->store('products', 'public');
                    $validated['image_path'] = '/storage/' . $localPath;
                    \Log::info('Image saved to local storage as fallback during update', ['path' => $validated['image_path']]);
                } catch (\Exception $localError) {
                    \Log::error('Local storage fallback also failed during update', ['error' => $localError->getMessage()]);
                }
            }
        }

        // Extract variants from validated data (not part of product update)
        $variants = $validated['variants'] ?? [];
        $newVariants = $validated['new_variants'] ?? [];
        unset($validated['variants'], $validated['new_variants']);

        // Handle legacy products without variants - update current_stock if provided
        if ($product->variants()->count() === 0 && isset($validated['current_stock'])) {
            // Keep the provided current_stock value
        } else {
            // For products with variants, calculate from variant stock
            $totalStock = $product->variants()->sum('stock_quantity');
            $validated['current_stock'] = $totalStock;
        }

        // Update product base info
        $product->update($validated);

        // Update existing variants
        if (!empty($variants)) {
            foreach ($variants as $variantData) {
                $variant = $product->variants()->where('id', $variantData['id'])->first();
                
                if (!$variant) {
                    continue;
                }

                // Check if this variant should be deleted
                if ($variantData['delete'] == '1') {
                    $variant->delete();
                    \Log::info('Variant deleted', ['variant_id' => $variant->id, 'variant_name' => $variant->name]);
                } else {
                    // Update variant data
                    $variant->update([
                        'name' => $variantData['name'] ?? $variant->name,
                        'stock_quantity' => $variantData['stock_quantity'],
                        'price_modifier' => $variantData['price_modifier'] ?? $variant->price_modifier,
                        'size' => $variantData['size'] ?? $variant->size,
                        'color' => $variantData['color'] ?? $variant->color,
                        'weight' => $variantData['weight'] ?? $variant->weight,
                    ]);
                    \Log::info('Variant updated', ['variant_id' => $variant->id, 'variant_name' => $variant->name]);
                }
            }
            // Recalculate total stock after updating/deleting variants
            $totalStock = $product->variants()->sum('stock_quantity');
            $product->update(['current_stock' => $totalStock]);
        }

        // Create new variants if adding to legacy product
        if (!empty($newVariants)) {
            foreach ($newVariants as $variantData) {
                $product->variants()->create([
                    'name' => $variantData['name'],
                    'stock_quantity' => $variantData['stock_quantity'],
                    'price_modifier' => $variantData['price_modifier'] ?? 0,
                    'size' => $variantData['size'] ?? null,
                    'color' => $variantData['color'] ?? null,
                    'weight' => $variantData['weight'] ?? null,
                    'status' => $product->status,
                ]);
            }
            // Recalculate total stock after creating variants
            $totalStock = $product->variants()->sum('stock_quantity');
            $product->update(['current_stock' => $totalStock]);
        }

        return redirect()->route('admin.inventory.index')
            ->with('success', 'Product and variants updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Product update failed', [
                'product_id' => $product->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['image']),
            ]);
            return redirect()->back()->withInput()->with('error', 'Failed to update product: ' . $e->getMessage());
        }
    }

    /**
     * Delete a product from the database.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        try {
            // Delete associated image from Supabase Storage if it exists
            if ($product->image_path) {
                try {
                    $this->deleteSupabaseImage($product->image_path);
                } catch (\Exception $storageException) {
                    // Log the storage error but continue with deletion
                    \Log::warning('Failed to delete product image from Supabase: ' . $storageException->getMessage());
                }
            }

            $productName = $product->name;
            
            // Delete the product (variants will be cascade deleted via FK)
            $product->delete();

            // Always return JSON if Accept header or X-Requested-With header indicates AJAX
            $isAjax = request()->header('Accept') === 'application/json' || 
                      request()->header('X-Requested-With') === 'XMLHttpRequest';
            
            if ($isAjax || request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "Product '{$productName}' deleted successfully!",
                ], 200);
            }

            // Return redirect for traditional form submissions
            return redirect()->route('admin.inventory.index')
                ->with('success', "Product '{$productName}' deleted successfully!");
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Product deletion failed: ' . $e->getMessage(), [
                'product_id' => $product->id,
                'exception' => $e
            ]);

            // Always return JSON if Accept header or X-Requested-With header indicates AJAX
            $isAjax = request()->header('Accept') === 'application/json' || 
                      request()->header('X-Requested-With') === 'XMLHttpRequest';
            
            if ($isAjax || request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete product: ' . $e->getMessage(),
                ], 500);
            }

            // Return redirect for traditional form submissions
            return redirect()->route('admin.inventory.index')
                ->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }

    /**
     * Delete an image from Supabase Storage.
     *
     * Extracts the storage path from the full public URL and deletes the file.
     *
     * @param  string  $imageUrl  The full public URL of the image
     * @return bool
     */
    private function deleteSupabaseImage(string $imageUrl): bool
    {
        try {
            // Extract the storage path from the full URL
            // URL format: https://<project-ref>.supabase.co/storage/v1/object/public/<bucket>/<path>
            $baseUrl = env('AWS_URL');

            if ($baseUrl && str_starts_with($imageUrl, $baseUrl)) {
                // Extract path after the base URL
                $storagePath = ltrim(str_replace($baseUrl, '', $imageUrl), '/');

                if ($storagePath) {
                    Storage::disk('supabase')->delete($storagePath);
                    \Log::info('Deleted image from Supabase', ['path' => $storagePath]);
                    return true;
                }
            }

            // Fallback: Try to delete from legacy local storage if it's a relative path
            if (!str_starts_with($imageUrl, 'http')) {
                Storage::disk('public')->delete($imageUrl);
                \Log::info('Deleted legacy local image', ['path' => $imageUrl]);
                return true;
            }

            return false;
        } catch (\Exception $e) {
            \Log::warning('Failed to delete Supabase image', [
                'url' => $imageUrl,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }
}
