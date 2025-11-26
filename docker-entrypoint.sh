#!/bin/sh
set -e

# Copy nested Vite manifest to expected location on startup if needed
if [ -f /var/www/html/public/build/.vite/manifest.json ] && [ ! -f /var/www/html/public/build/manifest.json ]; then
  cp /var/www/html/public/build/.vite/manifest.json /var/www/html/public/build/manifest.json
  echo "Copied Vite manifest from .vite/manifest.json to public/build/manifest.json"
fi

# Clear compiled view/cache to avoid old templates referencing missing manifest
php artisan view:clear || true
php artisan config:clear || true
php artisan cache:clear || true

# Ensure storage & bootstrap cache permissions - best effort
chown -R www-data:www-data /var/www/html || true
chmod -R 755 /var/www/html/storage || true
chmod -R 755 /var/www/html/bootstrap/cache || true

# Finally launch Apache in the foreground
exec "$@"
