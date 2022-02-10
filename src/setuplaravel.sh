#!/bin/sh

cd /app  
php artisan migrate:fresh
php artisan db:seed
php artisan serve --host=0.0.0.0