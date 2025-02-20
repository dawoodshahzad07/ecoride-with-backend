FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libmariadb-dev \
    default-mysql-client

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Configure Apache
RUN a2enmod rewrite
RUN service apache2 restart

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
