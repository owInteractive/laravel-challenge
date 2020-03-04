#!/bin/sh

composer install --no-interaction --no-suggest -o

# cache clear
php artisan view:clear
php artisan cache:clear
php artisan config:clear

# migrations
php artisan migrate --force

# permissions
chmod 777 /var/www/html/storage/logs/laravel.log
chmod 777 -R /var/www/html/storage/framework/views

# start php
php-fpm
