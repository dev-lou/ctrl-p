<?php
/**
 * Example: test Supabase S3 Storage Upload
 * Usage:
 *  - Copy to scripts/test_supabase_upload.php and run
 *  - Ensure your `.env` contains valid Supabase/AWS S3 credentials
 */
require __DIR__ . '/../vendor/autoload.php';

// Load Laravel environment
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Storage;

echo "=== Supabase S3 Storage Test ===\n\n";

// Show current configuration (shortened)
echo "AWS_ACCESS_KEY_ID: " . (env('AWS_ACCESS_KEY_ID') ? substr(env('AWS_ACCESS_KEY_ID'), 0, 10) . '...' : 'NOT SET') . "\n";
echo "AWS_SECRET_ACCESS_KEY: " . (env('AWS_SECRET_ACCESS_KEY') ? substr(env('AWS_SECRET_ACCESS_KEY'), 0, 10) . '...' : 'NOT SET') . "\n";
echo "AWS_BUCKET: " . env('AWS_BUCKET', 'NOT SET') . "\n";
echo "\n";

// This example shows how to exercise Storage::disk('supabase') without leaving actual secrets in the repo.
// It will upload a test file and then delete it.
