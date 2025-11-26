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
        // Skip for admin, API, asset routes, or health checks — we want admins to see errors and health checks to run.
        $path = $request->path();
        if (str_starts_with($path, 'admin') || str_starts_with($path, 'api') || $request->expectsJson() || $path === 'healthz' || $path === '_health') {
            return $next($request);
        }

        // If a Supabase REST fallback is configured we allow public pages to proceed
        // so controllers can render content using the REST fallback. This prevents
        // sending a degraded page for routes that can still be served.
        $hasSupabaseRestFallback = !empty(env('SUPABASE_SERVICE_ROLE_KEY')) || !empty(env('SUPABASE_ANON_KEY'));

        try {
            // Quick DB ping
            DB::select('SELECT 1');
            return $next($request);
        } catch (\Throwable $e) {
            // DB is unreachable - switch to file sessions/cache to prevent further DB errors
            config(['session.driver' => 'file']);
            config(['cache.default' => 'file']);
            
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
                        // Share default order counts to prevent View composer DB queries
                        return $this->renderFallbackView('home.homepage', ['featuredProducts' => $featured]);
                    }
                    
                    // Shop index
                    if ($path === 'shop' || $path === 'shop/') {
                        $page = max(1, (int) $request->get('page', 1));
                        $limit = 12;
                        $offset = ($page - 1) * $limit;
                        $filters = [];
                        if ($request->has('search')) $filters['search'] = $request->search;
                        if ($request->has('sort')) $filters['order'] = $request->get('sort');
                        $productsCollection = $fallback->getProducts($filters, $limit, $offset) ?: collect([]);
                        $productsCollection = collect($productsCollection)->map(fn($p) => new FallbackProduct($p));
                        // Create a simple LengthAwarePaginator so the view can paginate links
                        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
                            $productsCollection,
                            $productsCollection->count(),
                            $limit,
                            $page,
                            ['path' => $request->url(), 'query' => $request->query()]
                        );
                        return $this->renderFallbackView('shop.index', [
                            'products' => $paginator, 
                            'sort' => $request->get('sort', 'newest'), 
                            'search' => $request->get('search', '')
                        ]);
                    }
                    
                    // Shop product show (/shop/{slug})
                    if (str_starts_with($path, 'shop/') && count($request->segments()) >= 2) {
                        $slug = $request->segment(2);
                        $remote = $fallback->getProductBySlug($slug);
                        if ($remote) {
                            $product = new FallbackProduct($remote);
                            $variants = $fallback->getVariantsForProduct($product->id) ?: collect([]);
                            $product->variants = collect($variants)->map(fn($v) => (object)$v);
                            return $this->renderFallbackView('shop.show', ['product' => $product]);
                        }
                    }
                } catch (\Throwable $inner) {
                    logger()->warning('DegradedMode: REST fallback attempt failed: ' . $inner->getMessage(), ['path' => $path]);
                }
            }

            // For all other cases, return static degraded page
            $staticPath = storage_path('app/public/degraded.html');
            $publicPath = public_path('degraded.html');
            
            if (file_exists($staticPath)) {
                $content = file_get_contents($staticPath);
                return new Response($content, 503, ['Content-Type' => 'text/html']);
            }
            
            // Fallback to public directory
            if (file_exists($publicPath)) {
                $content = file_get_contents($publicPath);
                return new Response($content, 503, ['Content-Type' => 'text/html']);
            }

            $message = '<html><body><h1>Service temporarily unavailable</h1><p>We are currently experiencing technical difficulties. Please try again later.</p></body></html>';
            return new Response($message, 503, ['Content-Type' => 'text/html']);
        }
    }
    
    /**
     * Render a view with fallback data, including default order counts to prevent DB queries from View composers.
     */
    private function renderFallbackView(string $view, array $data = []): Response
    {
        // Add default order counts that View composers normally provide
        $data = array_merge([
            'pendingOrderCount' => 0,
            'processingOrderCount' => 0,
            'completedOrderCount' => 0,
            'totalOrderCount' => 0,
        ], $data);
        
        try {
            $content = view($view, $data)->render();
            return new Response($content, 200, ['Content-Type' => 'text/html']);
        } catch (\Throwable $e) {
            logger()->error('DegradedMode: View render failed: ' . $e->getMessage(), [
                'view' => $view,
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e; // Re-throw to be caught by outer handler
        }
    }
}
