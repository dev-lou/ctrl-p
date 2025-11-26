<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

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
        $hasSupabaseRestFallback = !empty(env('SUPABASE_SERVICE_ROLE_KEY'));

        // Allow some public read-only pages to pass through even if DB unreachable
        $publicPassThrough = function ($path, $request) {
            // Only allow GET requests to bypass the degraded page
            if (! $request->isMethod('GET')) {
                return false;
            }
            // Home route
            if ($path === '/') {
                return true;
            }
            // Shop and product pages
            if (str_starts_with($path, 'shop')) {
                return true;
            }
            // Static pages that can be safely rendered without DB writes
            if (in_array($path, ['contact', 'services', 'profile'])) {
                return true;
            }
            return false;
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
                // When the Supabase REST fallback key exists, allow requests to proceed
                // so controllers can use REST fallback to render content.
                logger()->info('DegradedMode: allowing request to continue due to SUPABASE_SERVICE_ROLE_KEY', ['path' => $path]);
                return $next($request);
            }

            // Allow a predefined set of public read-only pages to keep going (e.g., /, /shop)
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
