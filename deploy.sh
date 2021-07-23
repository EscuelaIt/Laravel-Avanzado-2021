#!/bin/sh

git pull

composer install --no-interaction --no-dev

composer dump-autoload --no-interaction --no-dev --optimize --classmap-authoritative

php artisan modelCache:clear
php artisan clear-compiled
php artisan route:cache
php artisan event:cache
php artisan view:cache
php artisan config:cache
php artisan queue:restart

systemctl reload php7.4-fpm.service
