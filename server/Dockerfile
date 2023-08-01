FROM php:8.2-cli

RUN pecl install swoole \
    && docker-php-ext-enable swoole

COPY server.php /var/www

ENTRYPOINT [ "php", "/var/www/server.php", "start" ]