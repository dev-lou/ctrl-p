<?php

namespace Laravel\Pail;

use Illuminate\Support\ServiceProvider;

/**
 * Minimal stub of Laravel\Pail\PailServiceProvider.
 * Ensures serverless deployments don't break when dev-only package is missing.
 */
class PailServiceProvider extends ServiceProvider
{
    public function register()
    {
        // no-op stub to satisfy provider registration in production
    }

    public function boot()
    {
        // no-op
    }
}
