FROM php:7.1-fpm

MAINTAINER Cesar Augusto <cesinhagutierres@gmail.com>

RUN apt-get update && apt-get install -y \
  libfreetype6-dev \
  libmcrypt-dev \
  libjpeg62-turbo-dev \
  libpng-dev \
  libxml2-dev \
  libpq-dev \
  libzip-dev

RUN docker-php-ext-install mbstring zip xml pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY start.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh

CMD [ "/entrypoint.sh" ]
