<?php
/**
 * Check Gemini config (reads config/services.gemini) and returns quick diagnostics
 * Usage: php scripts/check_gemini_env.php
 */
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Config;

$key = Config::get('services.gemini.api_key');
$model = Config::get('services.gemini.model');

if (empty($key)) {
    echo "GEMINI_API_KEY is NOT set in your environment/config.\n";
} else {
    $masked = substr($key, 0, 4) . str_repeat('*', max(0, strlen($key) - 8)) . substr($key, -4);
    echo "GEMINI_API_KEY is set: {$masked}\n";
}

if (empty($model)) {
    echo "GEMINI_MODEL is NOT set (using default: gemini-2.0-flash if missing).\n";
} else {
    echo "GEMINI_MODEL configured: {$model}\n";
}

echo "To verify actual supported models, run: php scripts/list_gemini_models.php\n";