#!/usr/bin/env bash
cd /application/code
composer install --no-plugins --no-scripts
php artisan migrate
