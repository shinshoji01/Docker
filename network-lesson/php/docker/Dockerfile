FROM php:7.2-apache
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo_mysql

#ENV APACHE_DOCUMENT_ROOT /path/to/new/root
#RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
#RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN apt-get update && apt-get install -y \
            libsndfile-dev \
            sudo \
            wget \
            vim
RUN apt install -y docker.io

RUN sudo echo "www-data ALL=NOPASSWD: ALL" >> /etc/sudoers
