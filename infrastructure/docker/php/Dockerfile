FROM php:7.4-fpm-buster
SHELL ["/bin/bash", "-oeux", "pipefail", "-c"]

ARG REDIS_VER=5.2.2

# timezone environment
ENV TZ=UTC \
  # locale
  LANG=en_US.UTF-8 \
  LANGUAGE=en_US:en \
  LC_ALL=en_US.UTF-8 \
  # composer environment
  COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer \
  # Laravel environment
  DB_CONNECTION=mysql \
  DB_HOST=db \
  DB_DATABASE=laravel_local \
  DB_USERNAME=root \
  DB_PASSWORD=secret \
  MAIL_HOST=mail \
  MAIL_PORT=1025 \
  REDIS_HOST=redis \
  CACHE_DRIVER=redis \
  SESSION_DRIVER=redis \
  QUEUE_DRIVER=redis

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
  apt-get -y install git curl libicu-dev libonig-dev libzip-dev unzip locales gnupg libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
  curl -sL https://deb.nodesource.com/setup_12.x | /bin/bash && \
  apt-get install -y nodejs && \
  npm install npm@latest -g && \
  : 'Install PHP Extensions' && \
  docker-php-ext-install -j$(nproc) pdo_mysql && \
  docker-php-ext-configure gd --with-freetype --with-jpeg && \
  docker-php-ext-install -j$(nproc) gd && \
  locale-gen en_US.UTF-8 && \
  localedef -f UTF-8 -i en_US en_US.UTF-8 && \
  mkdir /var/run/php-fpm && \
  mkdir /var/log/php && \
  git clone -b $REDIS_VER https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis && \
  docker-php-ext-install intl pdo_mysql mbstring zip bcmath redis && \
  composer config -g process-timeout 3600 && \
  composer config -g repos.packagist composer https://packagist.jp && \
  composer global require hirak/prestissimo

COPY ./php-fpm.d/zzz-www.conf /usr/local/etc/php-fpm.d/zzz-www.conf
COPY ./php.ini /usr/local/etc/php/php.ini

WORKDIR /work/ecsite