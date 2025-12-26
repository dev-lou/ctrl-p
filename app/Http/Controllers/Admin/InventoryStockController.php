<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\InventoryHistory;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class InventoryStockController extends Controller
{
    /**
     * Handle stock-in operation (add stock to inventory for a variant).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeIn(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
            'reference' => 'required|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $variant = ProductVariant::with('product')->findOrFail($request->variant_id);
        $product = $variant->product;

        try {
            DB::beginTransaction();

            // Capture old stock
            $oldStock = $variant->stock_quantity;

            // Update variant stock
            $variant->increment('stock_quantity', $request->quantity);

            // Create inventory history record
            InventoryHistory::create([
                'product_id' => $product->id,
                'variant_id' => $variant->id,
                'user_id' => auth()->id(),
                'type' => 'stock_in',
                'quantity_changed' => $request->quantity,
                'quantity_before' => $oldStock,
                'quantity_after' => $oldStock + $request->quantity,
                'reference' => $request->reference,
                'notes' => $request->notes,
            ]);

            AuditLog::logAction(
                'stock_in',
                'ProductVariant',
                $variant->id,
                ['stock_quantity' => $oldStock],
                [
                    'stock_quantity' => $oldStock + $request->quantity,
                    'reference' => $request->reference,
                    'notes' => $request->notes,
                ]
            );

            DB::commit();

            // Clear homepage caches so changes are reflected immediately
            Cache::forget('homepage.featured_products');
            Cache::forget('home.featured_products');

            return redirect()->route('admin.inventory.index')
                ->with('success', "Stock-in completed: +{$request->quantity} units added to {$product->name} ({$variant->name})");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error processing stock-in: ' . $e->getMessage());
        }
    }

    /**
     * Handle stock-out operation (remove stock from inventory for a variant).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeOut(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
            'reason' => 'required|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $variant = ProductVariant::with('product')->findOrFail($request->variant_id);
        $product = $variant->product;

        // Check if enough stock available
        if ($request->quantity > $variant->stock_quantity) {
            return redirect()->back()
                ->with('error', "Insufficient stock. Available: {$variant->stock_quantity}, Requested: {$request->quantity}");
        }

        try {
            DB::beginTransaction();

            // Capture old stock
            $oldStock = $variant->stock_quantity;

            // Update variant stock
            $variant->decrement('stock_quantity', $request->quantity);

            // Create inventory history record
            InventoryHistory::create([
                'product_id' => $product->id,
                'variant_id' => $variant->id,
                'user_id' => auth()->id(),
                'type' => 'stock_out',
                'quantity_changed' => -$request->quantity,
                'quantity_before' => $oldStock,
                'quantity_after' => $oldStock - $request->quantity,
                'reference' => $request->reason,
                'notes' => $request->notes,
            ]);

            AuditLog::logAction(
                'stock_out',
                'ProductVariant',
                $variant->id,
                ['stock_quantity' => $oldStock],
                [
                    'stock_quantity' => $oldStock - $request->quantity,
                    'reason' => $request->reason,
                    'notes' => $request->notes,
                ]
            );

            DB::commit();

            // Clear homepage caches so changes are reflected immediately
            Cache::forget('homepage.featured_products');
            Cache::forget('home.featured_products');

            return redirect()->route('admin.inventory.index')
                ->with('success', "Stock-out completed: -{$request->quantity} units removed from {$product->name} ({$variant->name})");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error processing stock-out: ' . $e->getMessage());
        }
    }

    /**
     * Display the inventory history timeline.
     *
     * @return \Illuminate\View\View
     */
    public function history(): \Illuminate\View\View
    {
        $products = Product::active()->orderBy('name')->get();
        $history = InventoryHistory::query()
            ->with('product', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.inventory.history', [
            'history' => $history,
            'products' => $products,
        ]);
    }
}

