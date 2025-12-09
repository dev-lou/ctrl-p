<?php
/**
 * Diagnostic script to list available Gemini / Generative Language models
 * Usage: 
 *   - Copy to scripts/list_gemini_models.php
 *   - Set AUTH: export GEMINI_API_KEY="YOUR_API_KEY" or set in .env
 *   - Run: php scripts/list_gemini_models.php
 */
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

$apiKey = env('GEMINI_API_KEY') ?: getenv('GEMINI_API_KEY');
$endpoint = 'https://generativelanguage.googleapis.com/v1beta/models';

if (empty($apiKey)) {
    echo "GEMINI_API_KEY is not set. Set it in your environment or .env file.\n";
    exit(1);
}

$response = Http::withHeaders([
    'Content-Type' => 'application/json',
])->get($endpoint . '?key=' . $apiKey);

if (!$response->successful()) {
    echo "Failed to list models. Status: {$response->status()}\n";
    echo "Response body: \n" . $response->body() . "\n";
    exit(1);
}

$data = $response->json();

file_put_contents(__DIR__ . '/list_models_result.json', json_encode($data, JSON_PRETTY_PRINT));

echo "Models fetched. Saved to scripts/list_models_result.json\n";