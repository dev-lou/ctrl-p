<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\SupabaseFallback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{
    /**
     * Display the product shop page with all items and variants.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): \Illuminate\View\View
    {
        $query = Product::query()->active();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = htmlspecialchars($request->search, ENT_QUOTES, 'UTF-8');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price-low':
                $query->orderBy('base_price', 'asc');
                break;
            case 'price-high':
                $query->orderBy('base_price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Pagination
        try {
            $products = $query->paginate(12);
        } catch (\Throwable $e) {
            logger()->warning('ProductController@index: DB unavailable, using Supabase REST fallback: ' . $e->getMessage());
            $fallback = new SupabaseFallback();
            $page = max(1, (int) $request->get('page', 1));
            $limit = 12;
            $offset = ($page - 1) * $limit;
            $filters = [];
            if ($request->has('search') && $request->search) {
                $filters['search'] = $request->search;
            }
            $productsCollection = $fallback->getProducts($filters, $limit, $offset) ?: collect([]);
            $products = new LengthAwarePaginator(
                $productsCollection, // items
                $productsCollection->count(), // total (best-effort)
                $limit,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );
        }

        return view('shop.index', [
            'products' => $products,
            'sort' => $sort,
            'search' => $request->search,
        ]);
    }

    /**
     * Display a single product detail page.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product): \Illuminate\View\View
    {
        // Load relationships
        try {
            $product->load(['variants']);
        } catch (\Throwable $e) {
            logger()->warning('ProductController@show: DB unavailable, using Supabase REST fallback: ' . $e->getMessage());
            // Try to fetch via REST fallback using slug
            $fallback = new SupabaseFallback();
            $remote = $fallback->getProductBySlug($product->slug);
            if ($remote) {
                // Map remote object into a pseudo-product object for the view
                $product = $remote;
                $product->variants = $fallback->getVariantsForProduct($product->id) ?: collect([]);
            }
        }

        // Get reviews with pagination
        try {
            $reviews = $product->reviews()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        } catch (\Throwable $e) {
            logger()->warning('ProductController@show: reviews unavailable: ' . $e->getMessage());
            $reviews = collect([]);
        }

        // Calculate average rating
        $averageRating = $product->averageRating();

        // Get related products (active only)
        try {
            $relatedProducts = Product::query()
            ->active()
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();
        } catch (\Throwable $e) {
            logger()->warning('ProductController@show: related products fallback: ' . $e->getMessage());
            $relatedProducts = Cache::get('home.featured_products', collect([]));
        }

        // Check if current user can review (authenticated and has completed order)
        $canReview = false;
        $userReview = null;
        
        if (auth()->check()) {
            $userReview = $product->reviews()->where('user_id', auth()->id())->first();
            
            if (!$userReview) {
                $canReview = \App\Models\Order::where('user_id', auth()->id())
                    ->where('status', 'completed')
                    ->whereHas('items', function ($query) use ($product) {
                        $query->where('product_id', $product->id);
                    })
                    ->exists();
            }
        }

        // Calculate rating breakdown
        $ratingBreakdown = [];
        for ($i = 5; $i >= 1; $i--) {
            $ratingBreakdown[$i] = $product->reviews()->where('rating', $i)->count();
        }

        return view('shop.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'reviews' => $reviews,
            'averageRating' => $averageRating,
            'canReview' => $canReview,
            'userReview' => $userReview,
            'ratingBreakdown' => $ratingBreakdown,
        ]);
    }
}

