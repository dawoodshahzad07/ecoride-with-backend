FROM php:8.2-apache

# Install mysqli extension and required dependencies
RUN apt-get update && apt-get install -y \
    libmariadb-dev \
    && docker-php-ext-install mysqli

# Optionally, install pdo_mysql if you use PDO for MySQL
# RUN docker-php-ext-install pdo_mysql

WORKDIR /var/www/html
COPY . .

# Make sure Apache can write to the session directory if you're using sessions
RUN chown -R www-data:www-data /var/www/html

# Enable Apache modules if needed
RUN a2enmod rewrite

CMD ["apache2-foreground"]

# Expose port 80
EXPOSE 80
