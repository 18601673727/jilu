#!/usr/bin/env bash
cd /application/code
composer install
ls -al $(which composer) | grep composer
php artisan migrate:install
php artisan migrate
