<?php

// Simple migration runner for Vercel
// Access via: https://your-domain.vercel.app/api/migrate.php?secret=YOUR_SECRET_KEY

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Simple security check
$secret = $_GET['secret'] ?? '';
$expectedSecret = getenv('MIGRATION_SECRET') ?: 'change-this-secret-key';

if ($secret !== $expectedSecret) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

try {
    // Run migrations
    $kernel->call('migrate', [
        '--force' => true,
    ]);
    
    echo json_encode([
        'success' => true,
        'message' => 'Migrations executed successfully'
    ]);
} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Migration failed',
        'message' => $e->getMessage()
    ]);
}
