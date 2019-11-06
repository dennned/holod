FROM php:7.2-fpm

RUN apt-get update && apt-get install -y \
&& docker-php-ext-install pdo pdo_mysql \
&& apt-get install -y git \
&& apt-get install -y zip unzip \
&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
&& composer --version \
&& apt-get install -y gnupg \
&& apt-get install curl -y && apt-get install apt-transport-https -y

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update && apt-get install yarn -y \
&& yarn add @symfony/webpack-encore --dev

