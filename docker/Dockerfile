FROM debian:stretch

WORKDIR /var/www

ADD . /var/www

ENV PATH $PATH:/usr/sbin:/usr/local/nginx/sbin

RUN apt-get update && \
    apt-get --no-install-recommends --no-install-suggests --yes --quiet install \
        apt-transport-https bash-completion lsb-release ca-certificates curl git gnupg imagemagick \
        less make mysql-client perceptualdiff procps ssh-client sudo unzip vim wget && \
    apt-get clean && apt-get --yes --quiet autoremove --purge && \
    rm -rf  /var/lib/apt/lists/* /tmp/* /var/tmp/* \
            /usr/share/doc/* /usr/share/groff/* /usr/share/info/* /usr/share/linda/* \
            /usr/share/lintian/* /usr/share/locale/* /usr/share/man/*

RUN sudo wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/php.list

RUN apt-get update && \
    apt-get --no-install-recommends --no-install-suggests --yes --quiet install \
        php7.0-dev php7.0-fpm php7.0-cli php7.0-apcu php7.0-mbstring php7.0-curl php7.0-gd php7.0-imagick php7.0-intl php7.0-bcmath \
        php7.0-mysql php7.0-xdebug php7.0-xml php7.0-zip php7.0-ldap php7.0-mongodb php7.0-sockets \
        gettext-base php7.0-soap php7.0-mcrypt php7.0-sqlite3

RUN service php7.0-fpm start

RUN wget https://nginx.org/keys/nginx_signing.key
RUN apt-key add nginx_signing.key

RUN apt-get update && apt-get install -y nginx
RUN curl -sL https://deb.nodesource.com/setup_11.x  | bash -
RUN apt-get -y install nodejs

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer

RUN apt-get install php-pear
RUN pecl channel-update pecl.php.net
RUN pecl install redis
RUN echo “extension=mongodb.so” > /etc/php/7.0/fpm/php.ini
RUN echo “extension=mongodb.so” > /etc/php/7.0/cli/php.ini
RUN echo “extension=redis.so” > /etc/php/7.0/fpm/php.ini
RUN echo “extension=redis.so” > /etc/php/7.0/cli/php.ini

COPY php-fpm.conf /etc/php-fpm.conf
COPY nginx.conf /etc/nginx/nginx.conf 
COPY php.ini /etc/php/7.0/fpm/php.ini
COPY php.ini /etc/php/7.0/cli/php.ini

VOLUME ["/var/run/php"]

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
USER www


EXPOSE 9000
