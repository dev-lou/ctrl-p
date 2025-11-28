<?php
// Example: test neon connection (use placeholders instead of real credentials)
$url = 'postgresql://neondb_owner:YOUR_NEON_PASSWORD@ep-noisy-mud-a1r3q36o-pooler.ap-southeast-1.aws.neon.tech:5432/neondb?sslmode=require&options=--project%3Dep-noisy-mud-a1r3q36o-pooler';
$parts = parse_url($url);
parse_str($parts['query'] ?? '', $q);

$dsn = "pgsql:host={$parts['host']};port={$parts['port']};dbname=" . ltrim($parts['path'], '/');
if (isset($q['sslmode'])) {
    $dsn .= ';sslmode=' . $q['sslmode'];
}
if (isset($q['options'])) {
    $dsn .= ';options=' . $q['options'];
}

try {
    $pdo = new PDO($dsn, $parts['user'], $parts['pass'], [PDO::ATTR_TIMEOUT => 10]);
    echo "OK\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
