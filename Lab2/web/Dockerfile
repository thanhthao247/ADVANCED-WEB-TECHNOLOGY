FROM php:8.2-apache
RUN docker-php-ext-install pdo pdo_mysql || true
RUN a2enmod rewrite
COPY php.ini $PHP_INI_DIR/conf.d/app.ini
WORKDIR /var/www/html
