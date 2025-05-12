# Use official PHP image with Apache
FROM php:8.2-apache

# Install common PHP extensions (you can add more if needed)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable URL rewriting for Apache
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy all files from your repo into the Apache root
COPY . /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Enable .htaccess overrides (optional)
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Expose Apache port
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
