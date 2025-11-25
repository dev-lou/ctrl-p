<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Testing Neon PostgreSQL Connection...\n";
echo str_repeat("=", 50) . "\n\n";

try {
    // Test PDO connection
    $pdo = DB::connection()->getPdo();
    echo "✅ PDO Connection: SUCCESS\n";
    
    // Get server version
    $version = $pdo->getAttribute(PDO::ATTR_SERVER_VERSION);
    echo "✅ PostgreSQL Version: $version\n";
    
    // Get database name
    $dbName = DB::connection()->getDatabaseName();
    echo "✅ Database Name: $dbName\n";
    
    // Test query
    $result = DB::select("SELECT current_database(), current_user, version()");
    echo "✅ Current Database: " . $result[0]->current_database . "\n";
    echo "✅ Current User: " . $result[0]->current_user . "\n";
    echo "✅ Server Info: " . substr($result[0]->version, 0, 50) . "...\n";
    
    echo "\n" . str_repeat("=", 50) . "\n";
    echo "🎉 Connection to Neon PostgreSQL is working!\n";
    
} catch (\Exception $e) {
    echo "❌ Connection Failed!\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "\nTroubleshooting:\n";
    echo "1. Check DB_HOST in .env\n";
    echo "2. Verify DB_PASSWORD is correct\n";
    echo "3. Ensure DB_SSLMODE=require is set\n";
    exit(1);
}
