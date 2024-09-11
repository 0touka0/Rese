FROM php:7.4.9-fpm

COPY php.ini /usr/local/etc/php/

# 必要なパッケージをインストール
RUN apt update \
  && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip  libpng-dev libmagickwand-dev --no-install-recommends \
  && docker-php-ext-install pdo_mysql zip gd \
  && docker-php-ext-enable gd \
  && apt-get clean && rm -rf /var/lib/apt/lists/*

  # peclを使ってimagickをインストールし、すぐに有効化
RUN pecl install imagick \
  && docker-php-ext-enable imagick

# Composer をインストールして最新バージョンに更新
RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

# Install Laravel 8
RUN composer create-project "laravel/laravel=8.*" . --prefer-dist

# Laravel Qrcodeライブラリをインストール
RUN composer require simplesoftwareio/simple-qrcode

WORKDIR /var/www