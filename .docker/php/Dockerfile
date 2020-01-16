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

RUN mkdir -p /run/php

COPY ./www.conf /etc/php/7.2/fpm/pool.d/

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'c5b9b6d368201a9db6f74e2611495f369991b72d9c8cbd3ffbc63edff210eb73d46ffbfce88669ad33695ef77dc76976') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php --filename=composer --install-dir=/usr/local/bin
RUN php -r "unlink('composer-setup.php');"

CMD ["php-fpm7.2", "-F"]