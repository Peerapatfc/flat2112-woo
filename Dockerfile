FROM wordpress:6.4-apache

# Install additional PHP extensions and tools
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Copy custom wp-config.php if exists
COPY wp-config.php /var/www/html/ 2>/dev/null || true

# Copy custom theme/plugins if they exist
COPY wp-content/ /var/www/html/wp-content/ 2>/dev/null || true

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]