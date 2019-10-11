FROM dockage/php:7-fpm

RUN apk --no-cache --update add
RUN apk add composer
RUN apk add confd@testing
RUN apk add file
RUN apk add git
RUN apk add mariadb-client 
RUN apk add openssh-client 
RUN apk add openssl
RUN apk add php7-bcmath
RUN apk add php7-ctype
RUN apk add php7-curl
RUN apk add php7-dom
RUN apk add php7-gd
RUN apk add php7-gettext
RUN apk add php7-iconv
RUN apk add php7-intl
RUN apk add php7-json
RUN apk add php7-mbstring
RUN apk add php7-mcrypt
RUN apk add php7-phar
RUN apk add php7-session
RUN apk add php7-simplexml 
RUN apk add php7-soap
RUN apk add php7-tokenizer 
RUN apk add php7-xml
RUN apk add php7-xmlreader 
RUN apk add php7-xmlwriter 
RUN apk add php7-zip
RUN apk add php7-zlib
RUN apk add php7-redis
RUN apk add php7-xdebug
RUN apk add php7-pgsql
RUN apk add php7-pdo_pgsql
RUN apk add php7-fileinfo

COPY ./www.conf /etc/php/7.3/php-fpm.d/