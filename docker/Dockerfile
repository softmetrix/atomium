FROM php:7.2-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/atomium/web
RUN apt update -y
RUN apt install zip unzip wget -y
RUN docker-php-ext-install mysqli pdo_mysql
WORKDIR /var/www/html
COPY atomium.zip ./
RUN unzip atomium.zip
RUN rm atomium.zip
WORKDIR /var/www/html/atomium
COPY config.php ./config
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN sed -ri -e "s!getenv\('SCRIPTS_PATH'\)!'/var/www/html/scripts'!g" /var/www/html/atomium/config/config.php
RUN a2enmod rewrite
RUN chmod -R a+w /var/www/html/atomium/runtime
RUN chmod -R a+w /var/www/html/atomium/web/assets
RUN chmod a+x /var/www/html/atomium/install