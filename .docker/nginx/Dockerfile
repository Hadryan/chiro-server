FROM nginx

COPY ./default.conf /etc/nginx/conf.d/default.conf

RUN mkdir -p /app/public/

COPY ./index.php /app/public/index.php