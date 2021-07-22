FROM php:7.4.20-fpm-buster

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html/app
