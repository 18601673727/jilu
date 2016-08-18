#!/usr/bin/env bash
cd /application/code
chmod -R 755 storage bootstrap/cache
composer install --no-plugins --no-scripts
php artisan migrate
