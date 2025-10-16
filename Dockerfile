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

# Copy custom wp-config.php
COPY wp-config.php /var/www/html/

# Copy custom theme/plugins
COPY wp-content/ /var/www/html/wp-content/

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]