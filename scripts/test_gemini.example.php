<?php
/**
 * Example test script to exercise Gemini chat service.
 *
 * Usage:
 *  - Copy to scripts/test_gemini.php
 *  - Ensure `.env` contains `GEMINI_API_KEY` and `GEMINI_MODEL` or provide as env vars
 *  - Run: php scripts/test_gemini.php
 */
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$service = app(App\Services\GeminiChatService::class);
$result = $service->chat('hello from test script');
file_put_contents(__DIR__ . '/test_gemini_result.json', json_encode($result, JSON_PRETTY_PRINT));
print_r($result);
