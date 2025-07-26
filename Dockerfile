# Use the official PHP-Apache image
FROM php:8.2-apache

# Install required PHP extensions (if needed)
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite (for pretty URLs if needed)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html/

# Set permissions for uploads directory
RUN mkdir -p /var/www/html/uploads \
    && chown -R www-data:www-data /var/www/html/uploads \
    && chmod -R 755 /var/www/html/uploads

# Expose port 80
EXPOSE 80

# Set recommended PHP.ini settings
COPY --from=php:8.2-apache /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

# Start Apache in the foreground
CMD ["apache2-foreground"] 