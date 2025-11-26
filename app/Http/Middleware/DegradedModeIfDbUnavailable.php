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
        $hasSupabaseRestFallback = !empty(config('services.supabase.service_role_key')) || !empty(config('services.supabase.anon_key'));

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
                logger()->info('DegradedMode: Attempting REST fallback', [
                    'path' => $path, 
                    'path_length' => strlen($path), 
                    'is_root' => ($path === '' || $path === '/'),
                    'is_shop' => ($path === 'shop' || $path === 'shop/'),
                    'is_product' => str_starts_with($path, 'shop/'),
                    'segments' => $request->segments(),
                ]);
                try {
                    $fallback = new SupabaseFallback();
                    
                    // Home page (root path is empty string in Laravel)
                    if ($path === '' || $path === '/') {
                        logger()->info('DegradedMode: Fetching featured products for homepage');
                        $featured = $fallback->getFeaturedProducts(6);
                        if ($featured === null) {
                            logger()->warning('DegradedMode: getFeaturedProducts returned null');
                            throw new \Exception('REST API returned null');
                        }
                        logger()->info('DegradedMode: Got featured products', ['count' => $featured->count()]);
                        $featured = collect($featured)->map(fn($p) => new FallbackProduct($p));
                        logger()->info('DegradedMode: Rendering homepage view');
                        try {
                            return $this->renderFallbackView('home.homepage', ['featuredProducts' => $featured]);
                        } catch (\Throwable $viewError) {
                            logger()->error('DegradedMode: Homepage view failed, trying minimal fallback', [
                                'error' => $viewError->getMessage(),
                                'file' => $viewError->getFile(),
                                'line' => $viewError->getLine(),
                            ]);
                            // Return minimal HTML with products as fallback
                            $html = '<!DOCTYPE html><html><head><title>Ctrl+P</title></head><body>';
                            $html .= '<h1>Ctrl+P - Products</h1><p>Homepage in maintenance mode.</p>';
                            $html .= '<ul>';
                            foreach ($featured as $product) {
                                $html .= '<li><a href="/shop/' . ($product->slug ?? '') . '">' . htmlspecialchars($product->name ?? 'Unknown') . '</a> - ₱' . number_format($product->base_price ?? 0, 2) . '</li>';
                            }
                            $html .= '</ul></body></html>';
                            return new Response($html, 200, ['Content-Type' => 'text/html']);
                        }
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
                    $segments = $request->segments();
                    $segmentCount = count($segments);
                    logger()->info('DegradedMode: Checking product path', [
                        'path' => $path,
                        'segments' => $segments,
                        'segment_count' => $segmentCount,
                        'starts_with_shop' => str_starts_with($path, 'shop/'),
                        'should_enter_product_block' => (str_starts_with($path, 'shop/') && $segmentCount >= 2),
                    ]);
                    
                    if (str_starts_with($path, 'shop/') && $segmentCount >= 2) {
                        $slug = $request->segment(2);
                        logger()->info('DegradedMode: ENTERED product block - Fetching product by slug', ['slug' => $slug]);
                        try {
                            $remote = $fallback->getProductBySlug($slug);
                            logger()->info('DegradedMode: getProductBySlug result', [
                                'slug' => $slug,
                                'remote_is_null' => ($remote === null),
                                'remote_type' => gettype($remote),
                            ]);
                        } catch (\Throwable $fetchError) {
                            logger()->error('DegradedMode: getProductBySlug threw exception', [
                                'slug' => $slug,
                                'error' => $fetchError->getMessage(),
                            ]);
                            $remote = null;
                        }
                        if ($remote) {
                            $remoteId = is_object($remote) ? ($remote->id ?? 'no-id') : ($remote['id'] ?? 'no-id');
                            logger()->info('DegradedMode: Creating FallbackProduct', ['remote_id' => $remoteId]);
                            $product = new FallbackProduct($remote);
                            $variants = $fallback->getVariantsForProduct($product->id) ?: collect([]);
                            $product->variants = collect($variants)->map(fn($v) => (object)$v);
                            logger()->info('DegradedMode: About to render product view', ['product_name' => $product->name]);
                            try {
                                return $this->renderFallbackView('shop.show', ['product' => $product]);
                            } catch (\Throwable $viewError) {
                                logger()->error('DegradedMode: Product view failed', [
                                    'error' => $viewError->getMessage(),
                                    'file' => $viewError->getFile(),
                                    'line' => $viewError->getLine(),
                                ]);
                                // Minimal product page fallback
                                $html = '<!DOCTYPE html><html><head><title>' . htmlspecialchars($product->name) . ' - Ctrl+P</title></head><body>';
                                $html .= '<h1>' . htmlspecialchars($product->name) . '</h1>';
                                $html .= '<p>Price: ₱' . number_format($product->base_price, 2) . '</p>';
                                $html .= '<p>' . htmlspecialchars($product->description ?? '') . '</p>';
                                $html .= '<p><a href="/shop">← Back to Shop</a></p>';
                                $html .= '</body></html>';
                                return new Response($html, 200, ['Content-Type' => 'text/html']);
                            }
                        } else {
                            logger()->warning('DegradedMode: Product not found or fetch failed', ['slug' => $slug]);
                        }
                    } else {
                        logger()->info('DegradedMode: Did NOT enter product block', ['path' => $path]);
                    }
                    
                    // Auth pages - show friendly maintenance message
                    if (in_array($path, ['login', 'register', 'password/reset', 'password/email'])) {
                        return $this->renderMaintenancePage('Login & Registration', 
                            'User accounts and login functionality are temporarily unavailable while we perform maintenance. ' .
                            'You can still browse our products!',
                            [['url' => '/', 'text' => 'Go to Homepage'], ['url' => '/shop', 'text' => 'Browse Products']]
                        );
                    }
                    
                    // Cart page
                    if ($path === 'cart' || str_starts_with($path, 'cart/')) {
                        return $this->renderMaintenancePage('Shopping Cart', 
                            'The shopping cart is temporarily unavailable while we perform maintenance. ' .
                            'Please try again in a few minutes.',
                            [['url' => '/', 'text' => 'Go to Homepage'], ['url' => '/shop', 'text' => 'Browse Products']]
                        );
                    }
                    
                    // Checkout
                    if (str_starts_with($path, 'checkout')) {
                        return $this->renderMaintenancePage('Checkout', 
                            'Checkout is temporarily unavailable while we perform maintenance. ' .
                            'Your cart items will be preserved. Please try again shortly.',
                            [['url' => '/', 'text' => 'Go to Homepage'], ['url' => '/shop', 'text' => 'Browse Products']]
                        );
                    }
                    
                    // Orders
                    if (str_starts_with($path, 'orders')) {
                        return $this->renderMaintenancePage('Order History', 
                            'Order history is temporarily unavailable while we perform maintenance. ' .
                            'Please try again in a few minutes.',
                            [['url' => '/', 'text' => 'Go to Homepage'], ['url' => '/shop', 'text' => 'Browse Products']]
                        );
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
    
    /**
     * Render a user-friendly maintenance page for features that require DB access.
     */
    private function renderMaintenancePage(string $title, string $message, array $links = []): Response
    {
        $linksHtml = '';
        foreach ($links as $link) {
            $linksHtml .= '<a href="' . htmlspecialchars($link['url']) . '" style="display:inline-block;margin:10px 10px 10px 0;padding:12px 24px;background:#3b82f6;color:white;text-decoration:none;border-radius:6px;font-weight:500;">' . htmlspecialchars($link['text']) . '</a>';
        }
        
        $html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . htmlspecialchars($title) . ' - Ctrl+P</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .container { background: white; border-radius: 16px; padding: 40px; max-width: 500px; text-align: center; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); }
        .icon { font-size: 64px; margin-bottom: 20px; }
        h1 { color: #1f2937; margin-bottom: 16px; font-size: 24px; }
        p { color: #6b7280; line-height: 1.6; margin-bottom: 24px; }
        .links { margin-top: 20px; }
        .status { background: #fef3c7; color: #92400e; padding: 12px 20px; border-radius: 8px; margin-bottom: 24px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">🔧</div>
        <div class="status">Maintenance Mode</div>
        <h1>' . htmlspecialchars($title) . '</h1>
        <p>' . htmlspecialchars($message) . '</p>
        <div class="links">' . $linksHtml . '</div>
    </div>
</body>
</html>';
        
        return new Response($html, 503, ['Content-Type' => 'text/html']);
    }
}
