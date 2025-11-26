<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Display the home page with announcements and hero section.
     *
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        // Try to fetch announcements, caching them for 10 minutes
        try {
            $announcements = Cache::remember('home.announcements', now()->addMinutes(10), function () {
                return Announcement::published()->pinned()->limit(3)->get();
            });
        } catch (\Throwable $e) {
            logger()->warning('Unable to fetch announcements due to DB connectivity: ' . $e->getMessage());
            $announcements = Cache::get('home.announcements', collect([]));
        }

        // Fetch featured products (newest, with active variants that have stock)
        try {
            $featuredProducts = Cache::remember('home.featured_products', now()->addMinutes(10), function () {
                return Product::active()
                    ->with('variants')
                    ->orderBy('created_at', 'desc')
                    ->limit(8)
                    ->get()
                    ->filter(function ($product) {
                        // Only include products that have at least one active variant with stock
                        return $product->variants()
                            ->where('status', 'active')
                            ->where('stock_quantity', '>', 0)
                            ->exists();
                    });
            });
        } catch (\Throwable $e) {
            logger()->warning('Unable to fetch featured products for HomeController due to DB connectivity: ' . $e->getMessage());
            $featuredProducts = Cache::get('home.featured_products', collect([]));
        }

        return view('home.index', [
            'announcements' => $announcements,
            'featuredProducts' => $featuredProducts,
        ]);
    }
}
 

