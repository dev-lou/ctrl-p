#!/bin/sh
set -e

# Copy nested Vite manifest to expected location on startup if needed
if [ -f /var/www/html/public/build/.vite/manifest.json ] && [ ! -f /var/www/html/public/build/manifest.json ]; then
  cp /var/www/html/public/build/.vite/manifest.json /var/www/html/public/build/manifest.json
  echo "Copied Vite manifest from .vite/manifest.json to public/build/manifest.json"
fi

# Clear ALL caches to ensure fresh config is used
echo "Clearing all caches..."
php artisan config:clear || true
php artisan cache:clear || true
php artisan view:clear || true
php artisan route:clear || true
rm -f bootstrap/cache/config.php || true
rm -f bootstrap/cache/routes-v7.php || true

# Run database migrations (if DB is reachable)
echo "Attempting database migrations..."
php artisan migrate --force 2>&1 || echo "Migration failed or DB unreachable - continuing anyway"

# Try to prime caches for the homepage. This is a best-effort
# operation that helps the app serve cached content when the DB is unreachable.
php artisan app:prime-cache || true

# Ensure storage & bootstrap cache permissions - best effort
chown -R www-data:www-data /var/www/html || true
chmod -R 755 /var/www/html/storage || true
chmod -R 755 /var/www/html/bootstrap/cache || true

# Finally launch Apache in the foreground
exec "$@"
