#!/usr/bin/env bash
cd /application/code
chmod -R 777 storage bootstrap/cache
composer install --no-plugins --no-scripts
php artisan migrate
