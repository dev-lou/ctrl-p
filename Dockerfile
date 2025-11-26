# =============================================================================
# Laravel Production Dockerfile for Render
# Base: PHP 8.2 with Apache
# Stack: Laravel, Blade, Vite (Tailwind), Neon PostgreSQL
# =============================================================================

FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# =============================================================================
# STEP 1: Install System Dependencies
# =============================================================================
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    unzip \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    # Install Node.js 20.x LTS (better than default apt nodejs)
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    # Clean up
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Verify Node.js and npm installation
RUN node --version && npm --version

# =============================================================================
# STEP 2: Install PHP Extensions
# =============================================================================
# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_pgsql \
        pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        opcache

# =============================================================================
# STEP 3: Configure Apache
# =============================================================================
# Enable Apache modules
RUN a2enmod rewrite headers

# Set Apache DocumentRoot to Laravel's public folder
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Update Apache configuration
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Configure Apache for Laravel (.htaccess support)
RUN echo '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

# =============================================================================
# STEP 4: Install Composer
# =============================================================================
# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# =============================================================================
# STEP 5: Copy Application Files
# =============================================================================
# Copy application files
COPY . .

# =============================================================================
# STEP 6: Install PHP Dependencies (Production)
# =============================================================================
# Install PHP dependencies (production)
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --prefer-dist \
    --no-progress

# =============================================================================
# STEP 7: Install Node.js Dependencies & Build Vite Assets
# =============================================================================
# Install Node.js dependencies and build assets
# Ensure devDependencies are installed during build so Vite is available
ENV NODE_ENV=development
# Install dependencies and build assets (ensure manifest is generated)
RUN export NPM_CONFIG_PRODUCTION=false \
    && echo "Node: $(node --version) npm: $(npm --version)" \
    && npm ci --no-audit --no-fund --include=dev --silent \
    && npm run build --silent || (echo "ERROR: npm run build failed"; echo "node_modules listing:"; ls -la node_modules || true; echo "build dir listing:"; ls -la public || true; exit 1) \
    # Handle Vite 7+ writing nested .vite/manifest.json - copy it to public/build/manifest.json when present
    && if [ -f public/build/.vite/manifest.json ] && [ ! -f public/build/manifest.json ]; then echo "Found .vite/manifest.json -> copying to public/build/manifest.json"; cp public/build/.vite/manifest.json public/build/manifest.json; echo "Manifest content:"; head -n 5 public/build/manifest.json || true; fi \
    && if [ ! -f public/build/manifest.json ]; then echo "ERROR: Vite manifest missing"; ls -la public/build || true; exit 1; fi
# Set production environment (optional - keeps environment cleaned for PHP runtime)
ENV NODE_ENV=production

# Remove node_modules after build to reduce image size
RUN rm -rf node_modules

# =============================================================================
# STEP 8: Configure PHP for Production
# =============================================================================
# Configure PHP for production
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Configure OPcache for maximum performance
RUN echo 'opcache.enable=1\n\
opcache.memory_consumption=256\n\
opcache.interned_strings_buffer=64\n\
opcache.max_accelerated_files=32531\n\
opcache.validate_timestamps=0\n\
opcache.save_comments=1\n\
opcache.fast_shutdown=1' > /usr/local/etc/php/conf.d/opcache.ini

# =============================================================================
# STEP 9: Set Permissions for Laravel
# =============================================================================
# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Create storage link
RUN php artisan storage:link || true
RUN php artisan view:clear || true
RUN php artisan config:clear || true

# =============================================================================
# STEP 10: Expose Port & Start Apache
# =============================================================================
# Expose port 80
EXPOSE 80

# Start Apache
# Copy and install entrypoint script that copies manifest and clears caches at startup
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Start the container through the entrypoint so startup tasks run first
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["apache2-foreground"]
