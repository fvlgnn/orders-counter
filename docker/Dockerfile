FROM php:7.3-apache

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

RUN docker-php-ext-install pdo_mysql mysqli

RUN a2enmod rewrite
RUN a2enmod headers
RUN a2enmod include
RUN a2enmod ssl
RUN a2enmod expires
RUN a2enmod actions
RUN a2enmod status
RUN a2enmod info

RUN service apache2 restart
