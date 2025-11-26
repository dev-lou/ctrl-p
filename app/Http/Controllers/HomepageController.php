<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\SupabaseFallback;
use App\DTO\FallbackProduct;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomepageController extends Controller
{
    /**
     * Display the modern homepage.
     */
    public function index(): View
    {
        // Get featured products (first 6 active products). Wrap in try/catch so
        // the homepage can still render when the DB is temporarily unreachable
        // (e.g., IPv6 connectivity issues on the host). If a DB exception occurs,
        // return an empty collection and log a warning.
        // Try to fetch featured products, caching them for 10 minutes.
        $featuredProducts = Cache::remember('homepage.featured_products', now()->addMinutes(10), function () {
            return Product::where('status', 'active')
                ->orderBy('created_at', 'desc')
                ->take(6)
                ->get();
        });

        if ($featuredProducts->isEmpty()) {
            // If cache is empty and DB connection failed, try to gracefully recover
            try {
                $featuredProducts = Product::where('status', 'active')
                    ->orderBy('created_at', 'desc')
                    ->take(6)
                    ->get();
            } catch (\Throwable $e) {
                logger()->warning('Unable to fetch featured products from DB: ' . $e->getMessage());
                // Try to use the Supabase REST fallback if configured
                try {
                    $fallback = new SupabaseFallback();
                    $remote = $fallback->getFeaturedProducts(6);
                    if ($remote && $remote->isNotEmpty()) {
                        // Map to fallback DTOs
                        $featuredProducts = $remote->map(fn($p) => new \App\DTO\FallbackProduct($p));
                        Cache::put('homepage.featured_products', $remote, now()->addMinutes(10));
                    } else {
                        // Try to use cached data even if empty; otherwise return empty collection
                        $featuredProducts = Cache::get('homepage.featured_products', collect([]));
                    }
                } catch (\Throwable $inner) {
                    logger()->warning('Supabase REST fallback failed: ' . $inner->getMessage());
                    $featuredProducts = Cache::get('homepage.featured_products', collect([]));
                }
            }
        }

        return view('home.homepage', [
            'featuredProducts' => $featuredProducts,
        ]);
    }
}
