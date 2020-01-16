#!/bin/bash

until nc -z -v -w30 $DB_HOST $DB_PORT
do
  echo "Waiting for database connection..."
  # wait for 5 seconds before check again
  sleep 5
done

sleep 3

cp /app/storage/app/* /app/public/storage/ -rf

chown www-data. /app/public/storage -R

php artisan migrate

php-fpm7.2 -F