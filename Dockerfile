FROM php:apache

RUN apt-get update \
 && apt-get install --no-install-recommends -y git unzip gnupg libpng-dev build-essential \
 && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
 && curl -sL https://deb.nodesource.com/setup_10.x | bash - \
 && apt-get install --no-install-recommends -y nodejs \
 && npm install --unsafe-perm=true -g node-sass spectacle-docs yamlinc \
 && rm -rf /var/lib/apt/lists/*
