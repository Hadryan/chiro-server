FROM ubuntu:18.04

RUN apt update
RUN apt install -y php7.2-bcmath
RUN apt install -y php7.2-ctype
RUN apt install -y php7.2-curl
RUN apt install -y php7.2-dom
RUN apt install -y php7.2-gd
RUN apt install -y php7.2-gettext
RUN apt install -y php7.2-iconv
RUN apt install -y php7.2-intl
RUN apt install -y php7.2-json
RUN apt install -y php7.2-mbstring
RUN apt install -y php7.2-phar
RUN apt install -y php7.2-simplexml 
RUN apt install -y php7.2-soap
RUN apt install -y php7.2-tokenizer 
RUN apt install -y php7.2-xml
RUN apt install -y php7.2-xmlreader 
RUN apt install -y php7.2-xmlwriter 
RUN apt install -y php7.2-zip
RUN apt install -y php7.2-redis
RUN apt install -y php7.2-pgsql
RUN apt install -y php7.2-fileinfo
RUN apt install -y php7.2-fpm
RUN apt install -y php7.2-pdo
RUN apt install -y vim
RUN apt install -y curl

RUN mkdir -p /run/php

COPY ./www.conf /etc/php/7.2/fpm/pool.d/

COPY ./install_composer.sh .

RUN chmod +x ./install_composer.sh

RUN bash ./install_composer.sh

RUN rm ./install_composer.sh

CMD ["php-fpm7.2", "-F"]