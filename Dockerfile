FROM code.putech.ir:5000/chiro-base-api

COPY . /app

WORKDIR /app

RUN cp .env.example .env

RUN php artisan key:generate

RUN chown www-data:www-data storage -R