#!/bin/sh
set -e

# Copy nested Vite manifest to expected location on startup if needed
if [ -f /var/www/html/public/build/.vite/manifest.json ] && [ ! -f /var/www/html/public/build/manifest.json ]; then
  cp /var/www/html/public/build/.vite/manifest.json /var/www/html/public/build/manifest.json
  echo "Copied Vite manifest from .vite/manifest.json to public/build/manifest.json"
fi

# Clear caches quickly (no DB required)
echo "Clearing caches..."
rm -f bootstrap/cache/config.php || true
rm -f bootstrap/cache/routes-v7.php || true
rm -f bootstrap/cache/packages.php || true
rm -f bootstrap/cache/services.php || true

# Ensure storage & bootstrap cache permissions
chown -R www-data:www-data /var/www/html || true
chmod -R 755 /var/www/html/storage || true
chmod -R 755 /var/www/html/bootstrap/cache || true

# Run migrations in background with timeout to not block startup
# This allows Apache to start immediately and pass health checks
echo "Starting migrations in background..."
(
  sleep 5  # Wait for Apache to start first
  echo "Running migrations..."
  timeout 30 php artisan migrate --force 2>&1 || echo "Migration skipped or failed"
  echo "Background migration task complete"
) &

# Launch Apache in the foreground immediately
echo "Starting Apache..."
exec "$@"
