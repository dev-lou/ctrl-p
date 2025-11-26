<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use App\Services\SupabaseFallback;
use App\DTO\FallbackProduct;

class DegradedModeIfDbUnavailable
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Skip for admin or asset or API routes — we want admins to see errors.
        $path = $request->path();
        if (str_starts_with($path, 'admin') || str_starts_with($path, 'api') || $request->expectsJson()) {
            return $next($request);
        }

        // If a Supabase REST fallback is configured we allow public pages to proceed
        // so controllers can render content using the REST fallback. This prevents
        // sending a degraded page for routes that can still be served.
        $hasSupabaseRestFallback = !empty(env('SUPABASE_SERVICE_ROLE_KEY')) || !empty(env('SUPABASE_ANON_KEY'));

        // Allow any GET public route (excluding admin and api paths) to pass-through
        // so controllers can rely on cache or REST fallback to render content.
        $publicPassThrough = function ($path, $request) {
            if (! $request->isMethod('GET')) {
                return false;
            }
            if (str_starts_with($path, 'admin') || str_starts_with($path, 'api')) {
                return false;
            }
            return true;
        };

        try {
            // Quick DB ping
            DB::select('SELECT 1');
            return $next($request);
        } catch (\Throwable $e) {
            // Enhanced log: include incoming IP and path for debugging on Render
            logger()->warning('DegradedMode: DB unreachable during request', [
                'path' => $path,
                'ip' => $request->ip(),
                'exception' => $e->getMessage(),
            ]);
            // If DB unreachable, return the static degraded HTML if it exists.
            $staticPath = storage_path('app/public/degraded.html');
            if ($hasSupabaseRestFallback) {
                // When the Supabase REST fallback key exists try to render common public pages
                // directly from Supabase REST to avoid controller DB queries and handler 503s.
                try {
                    $fallback = new SupabaseFallback();
                    // Home page
                    if ($path === '' || $path === '/') {
                        $featured = $fallback->getFeaturedProducts(6) ?: collect([]);
                        $featured = collect($featured)->map(fn($p) => new FallbackProduct($p));
                        return response()->view('home.homepage', ['featuredProducts' => $featured]);
                    }
                    // Shop index
                    if ($path === 'shop' || $path === 'shop/') {
                        // Collect parameters
                        $page = max(1, (int) $request->get('page', 1));
                        $limit = 12;
                        $offset = ($page - 1) * $limit;
                        $filters = [];
                        if ($request->has('search')) $filters['search'] = $request->search;
                        if ($request->has('sort')) $filters['order'] = $request->get('sort');
                        $products = $fallback->getProducts($filters, $limit, $offset) ?: collect([]);
                        $products = $products->map(fn($p) => new FallbackProduct($p));
                        return response()->view('shop.index', ['products' => $products]);
                    }
                    // Shop product show (/shop/{slug})
                    if (str_starts_with($path, 'shop/') && count($request->segments()) >= 2) {
                        $slug = $request->segment(2);
                        $remote = $fallback->getProductBySlug($slug);
                        if ($remote) {
                            $product = new FallbackProduct($remote);
                            $variants = $fallback->getVariantsForProduct($product->id) ?: collect([]);
                            $product->variants = collect($variants)->map(fn($v) => (object)$v);
                            return response()->view('shop.show', ['product' => $product]);
                        }
                    }
                } catch (\Throwable $inner) {
                    logger()->warning('DegradedMode: REST fallback attempt failed: ' . $inner->getMessage(), ['path' => $path]);
                }

                // If direct REST rendering failed, allow request to continue to controllers
                logger()->info('DegradedMode: allowing request to continue due to SUPABASE_SERVICE_ROLE_KEY', ['path' => $path]);
                return $next($request);
            }

            // Allow any GET public route to keep going (e.g., /, /shop, /about)
            if ($publicPassThrough($path, $request)) {
                logger()->info('DegradedMode: bypassing degraded page for public GET route', ['path' => $path]);
                return $next($request);
            }

            if (file_exists($staticPath)) {
                $content = file_get_contents($staticPath);
                return new Response($content, 503, ['Content-Type' => 'text/html']);
            }

            // Otherwise return a simple 503 JSON for health checks and non-HTML clients.
            if ($request->expectsJson()) {
                return response()->json(['status' => 'degraded', 'db' => 'unreachable'], 503);
            }

            $message = '<html><body><h1>Service temporarily unavailable</h1><p>We are currently experiencing technical difficulties. Please try again later.</p></body></html>';
            return new Response($message, 503, ['Content-Type' => 'text/html']);
        }
    }
}
