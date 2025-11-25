<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use App\Models\Order;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force https when APP_URL uses https or in production behind proxies
        if ($this->app->environment('production') || str_starts_with(config('app.url', ''), 'https://')) {
            URL::forceScheme('https');
        }
        // Define authorization gates
        $this->defineAuthorizationGates();

        // Share order counts with all views via View Composer
        View::composer('*', function ($view) {
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
        });
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

