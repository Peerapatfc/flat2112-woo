FROM wordpress:6.4-apache

# Install additional PHP extensions and tools
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    curl \
    vim \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*

# Configure PHP settings for WordPress
RUN { \
    echo 'upload_max_filesize = 64M'; \
    echo 'post_max_size = 64M'; \
    echo 'memory_limit = 256M'; \
    echo 'max_execution_time = 300'; \
    echo 'max_input_vars = 3000'; \
} > /usr/local/etc/php/conf.d/wordpress.ini

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Copy custom wp-config.php
COPY wp-config.php /var/www/html/

# Copy custom theme/plugins
COPY --chown=www-data:www-data wp-content/ /var/www/html/wp-content/

# Create uploads directory with proper permissions
RUN mkdir -p /var/www/html/wp-content/uploads \
    && chown -R www-data:www-data /var/www/html/wp-content/uploads \
    && chmod -R 755 /var/www/html/wp-content/uploads

# Enable Apache modules
RUN a2enmod rewrite headers expires

# Expose port 80
EXPOSE 80

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=60s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

# Start Apache
CMD ["apache2-foreground"]