<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
echo "session_driver=" . config('session.driver') . "\n";
echo "cache_default=" . config('cache.default') . "\n";
