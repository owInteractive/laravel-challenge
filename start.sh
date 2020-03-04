#!/bin/sh

cp /var/www/html/.env_dev /var/www/html/.env

composer install --no-interaction --no-suggest -o

php artisan key:generate

# cache clear
php artisan view:clear
php artisan cache:clear
php artisan config:clear

# permissions
chmod 777 /var/www/html/storage/logs/laravel.log
chmod 777 -R /var/www/html/storage/framework/views

# sqlite
touch /var/www/html/database/database.sqlite
# permission -rw
chmod 600 /var/www/html/database/database.sqlite

# migrations
php artisan migrate --force

# start php
php-fpm
