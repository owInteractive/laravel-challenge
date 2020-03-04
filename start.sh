#!/bin/sh

echo 'removendo composer.lock'
rm -Rf composer.lock

echo 'removendo vendor'
rm -Rf vendor

composer install --no-interaction --no-suggest

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
chmod 777 /var/www/html/database/database.sqlite

chown 1000:1000 /var/www/html/database && chmod 777 -R /var/www/html/database

# migrations
php artisan migrate --force

# jwt
# php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\JWTAuthServiceProvider"

# start php
php-fpm
