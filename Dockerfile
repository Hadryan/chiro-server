FROM 2hamed/php-base

RUN apt install -y netcat

COPY ./vendor /app/vendor
COPY ./storage /app/storage
COPY ./bootstrap /app/bootstrap
COPY ./resources /app/resources
COPY ./public /app/public
COPY ./routes /app/routes
COPY ./config /app/config
COPY ./database /app/database
COPY ./app /app/app
COPY ./composer.lock ./composer.json ./artisan ./.env.example ./startup.sh ./prepare.sh ./server.php /app/

WORKDIR /app

RUN cp .env.example .env

RUN php artisan key:generate

RUN chown www-data:www-data /app/public -R
RUN chown www-data:www-data /app/storage -R

CMD ["bash", "/app/startup.sh"]