FROM php:7.2-apache

RUN apt-get update && apt-get install -y \
            libsndfile-dev \
            sudo \
            wget \
            vim
RUN apt install -y docker.io

RUN sudo echo "www-data ALL=NOPASSWD: ALL" >> /etc/sudoers
