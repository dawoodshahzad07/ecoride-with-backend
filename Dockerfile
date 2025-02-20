FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Optionally, install pdo_mysql if you use PDO for MySQL
# RUN docker-php-ext-install pdo_mysql

WORKDIR /var/www/html
COPY . .
CMD ["apache2-foreground"]

# Expose port 80
EXPOSE 80
