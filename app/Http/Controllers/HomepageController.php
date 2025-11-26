<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        try {
            $featuredProducts = Product::where('status', 'active')
                ->orderBy('created_at', 'desc')
                ->take(6)
                ->get();
        } catch (\Throwable $e) {
            logger()->warning('Unable to fetch featured products: ' . $e->getMessage());
            $featuredProducts = collect([]);
        }

        return view('home.homepage', [
            'featuredProducts' => $featuredProducts,
        ]);
    }
}
