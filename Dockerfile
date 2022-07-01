FROM php:8.1-apache

# use development config
# https://hub.docker.com/_/php
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# install composer
# https://stackoverflow.com/a/58694421/1593188
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# install git
RUN apt-get -y update && apt-get -y install git

#install node
RUN apt-get -y update && apt-get -y install nodejs npm

#install yarn
RUN apt-get -y update && apt-get -y install yarn

# install mysql driver
RUN docker-php-ext-install pdo_mysql

# install intl requirements
RUN apt-get -y update && apt-get install -y libicu-dev

# install intl
RUN docker-php-ext-install intl

# install xdebug
# https://hub.docker.com/_/php
RUN pecl install xdebug && docker-php-ext-enable xdebug
COPY docker/php/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# set the document root in apache config
# https://stackoverflow.com/a/51457728/1593188
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

