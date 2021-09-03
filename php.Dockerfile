FROM php:7.4.20-fpm-buster

RUN apt-get update -y
RUN apt-get install -y libzip-dev zip
RUN docker-php-ext-install pdo pdo_mysql zip

WORKDIR /var/www/html/app
