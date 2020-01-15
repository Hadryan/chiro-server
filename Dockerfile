FROM 2hamed/chiro-base

COPY . /app

WORKDIR /app

RUN cp .env.example .env

RUN php artisan key:generate

RUN chown www-data:www-data storage -R