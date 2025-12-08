<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Extensions\NeonPostgresConnector;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register custom Neon Postgres connector to append endpoint and ensure options are sanitized.
        $this->app->bind('db.connector.pgsql', function () {
            return new NeonPostgresConnector();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // NOTE: DB connection checks are now handled lazily (on first actual query).
        // This prevents boot-time blocking when database is temporarily unreachable.
        // With Neon PostgreSQL (IPv4), the database should always be reachable from Render.
        // Ensure pgsql 'options' is always an array to prevent TypeErrors
        // when a `DATABASE_URL` query param named `options` is present
        // (Laravel's parser sets `options` to a string which conflicts
        // with the PDO options array). If a string arrives, clear it.
        $pgsql = config('database.connections.pgsql', []);
        if (isset($pgsql['options']) && is_string($pgsql['options'])) {
            config(['database.connections.pgsql.options' => []]);
        }

        // Force https when APP_URL uses https or in production behind proxies
        if ($this->app->environment('production') || str_starts_with(config('app.url', ''), 'https://')) {
            URL::forceScheme('https');
        }
        // Normalize any malformed DB options (e.g., from DATABASE_URL query params)
        // If 'options' is present and is a string, ensure we reset it to an empty array
        // so that PDO options do not cause runtime TypeErrors (see Connector::getOptions).
        try {
            $defaultDriver = config('database.default');
            $connOptions = config("database.connections.{$defaultDriver}.options");
            if (is_string($connOptions)) {
                // Avoid overriding when we actually do want PDO options; emptying is safer
                // than letting a string be passed to Connector->getOptions() which will blow up.
                config(["database.connections.{$defaultDriver}.options" => []]);
            }
        } catch (\Throwable $e) {
            // Do not let a mis-parsed config break the application bootstrap; just log and continue
            logger()->warning('Database options normalization failed: '.$e->getMessage());
        }

        // Define authorization gates
        $this->defineAuthorizationGates();

        // Share order counts with all views via View Composer
        // Skip for error views and console commands to prevent infinite loops
        // and avoid database queries during CLI tasks such as `php artisan`.
        View::composer('*', function ($view) {
        $viewName = $view->getName();
        
        // Skip error views, API responses, AND components (to prevent Blade compilation issues)
        if (str_starts_with($viewName, 'errors.') || 
            str_starts_with($viewName, 'errors::') ||
            str_starts_with($viewName, 'components.')) {
            $view->with([
                'pendingOrderCount' => 0,
                'processingOrderCount' => 0,
                'completedOrderCount' => 0,
                'totalOrderCount' => 0,
            ]);
            return;
        }
        
        try {
            $pendingOrderCount = Order::where('status', 'pending')->count();
            $processingOrderCount = Order::where('status', 'processing')->count();
            $completedOrderCount = Order::where('status', 'completed')->count();
            $totalOrderCount = Order::count();

            $view->with([
                'pendingOrderCount' => $pendingOrderCount,
                'processingOrderCount' => $processingOrderCount,
                'completedOrderCount' => $completedOrderCount,
                'totalOrderCount' => $totalOrderCount,
            ]);
        } catch (\Throwable $e) {
            // Fallback to zero counts if database query fails
            // Don't log excessively to avoid log spam
            $view->with([
                'pendingOrderCount' => 0,
                'processingOrderCount' => 0,
                'completedOrderCount' => 0,
                'totalOrderCount' => 0,
            ]);
        }
        });

        // Vite manifest fallback: In some Vite versions or setups, the manifest may be
        // emitted as public/build/.vite/manifest.json. To avoid runtime errors when
        // the app expects public/build/manifest.json, copy the nested manifest to the
        // expected path at runtime (only when necessary).
        try {
            $manifestDir = public_path('build');
            $legacyManifest = $manifestDir . DIRECTORY_SEPARATOR . '.vite' . DIRECTORY_SEPARATOR . 'manifest.json';
            $expectedManifest = $manifestDir . DIRECTORY_SEPARATOR . 'manifest.json';

            if (file_exists($legacyManifest) && !file_exists($expectedManifest)) {
                @copy($legacyManifest, $expectedManifest);
                logger()->info('Copied Vite manifest from nested .vite to build manifest', ['from' => $legacyManifest, 'to' => $expectedManifest]);
            }
        } catch (\Throwable $e) {
            logger()->warning('Failed to ensure Vite manifest was present: ' . $e->getMessage());
        }
    }

    /**
     * Define authorization gates.
     */
    private function defineAuthorizationGates(): void
    {
        Gate::define('manage-users', function ($user) {
            return true; // All authenticated users can manage users
        });
    }
}

