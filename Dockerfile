FROM php:8.2-apache
WORKDIR /var/www/html
COPY . .
CMD ["apache2-foreground"]
