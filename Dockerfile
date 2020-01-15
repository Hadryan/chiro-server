FROM 2hamed/chiro-base

COPY ./vendor /app/vendor
COPY ./storage /app/storage
COPY ./bootstrap /app/bootstrap
COPY ./app /app/app
COPY ./public /app/public
COPY ./routes /app/routes
COPY ./config /app/config
COPY ./database /app/database
COPY ./composer.lock ./composer.json ./artisan ./.env.example ./startup.sh ./server.php /app/

WORKDIR /app

RUN cp .env.example .env

RUN php artisan key:generate

RUN chown www-data:www-data storage -R