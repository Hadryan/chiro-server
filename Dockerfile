FROM code.putech.ir:5000/chiro-base-api

COPY . /app

WORKDIR /app

RUN chown www-data:www-data storage -R