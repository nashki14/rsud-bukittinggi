#!/bin/sh
set -e

echo "==> Clearing caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "==> Running migrations..."
php artisan migrate --force

echo "==> Caching config for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Starting PHP-FPM..."
php-fpm -D

echo "==> Starting Nginx..."
exec nginx -g "daemon off;"
