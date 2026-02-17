# Laravel Livewire Application
# Uses pre-built base image with PHP, Nginx, Supervisor, Node.js
FROM nexudev/laravel-livewire:latest

WORKDIR /var/www/html

# Copy application files
COPY . .

# Set proper ownership and permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Install PHP dependencies
RUN composer install --prefer-dist --optimize-autoloader --no-interaction --no-dev

# Install Node.js dependencies and build assets
RUN npm ci && npm run build

EXPOSE 8000

CMD ["/usr/local/bin/entrypoint.sh"]