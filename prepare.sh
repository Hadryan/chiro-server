#!/bin/bash

cp /app/storage/app/images /app/storage/app/public/ -rf
cp /app/storage/app/mock /app/storage/app/public/ -rf

chown www-data. /app/public -R

getopts ":r" refresh
if [[ $refresh == "r" ]]; then
    php artisan migrate:refresh
fi

getopts ":s" seed
if [[ $seed == "s" ]]; then
    php artisan db:seed
fi

php artisan db:seed --class=VoyagerDatabaseSeeder

php artisan hook:setup

php artisan storage:link

composer dump-autoload