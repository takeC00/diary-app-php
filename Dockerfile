FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql \
    && a2enmod rewrite

COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php/uploads.ini /usr/local/etc/php/conf.d/uploads.ini
COPY . /var/www/html

RUN find /var/www/html/public/images -type d -exec chmod 755 {} \; \
    && find /var/www/html/public/images -type f -exec chmod 644 {} \; \
    && chown -R www-data:www-data /var/www/html/public/images/uploads

WORKDIR /var/www/html
