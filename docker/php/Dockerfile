FROM php:7.4.9-fpm

# php.ini の設定をコピー
COPY php.ini /usr/local/etc/php/

# 必要なパッケージをインストールし、pdo_mysqlとzip拡張を有効化
RUN apt update \
  && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip libpng-dev libfreetype6-dev libjpeg62-turbo-dev \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install pdo_mysql zip gd \
  && pecl install imagick \
  && docker-php-ext-enable imagick

# Composer をインストールして最新バージョンに更新
RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

# Laravel 8 をインストール
RUN composer create-project "laravel/laravel=8.*" . --prefer-dist

# 作業ディレクトリを /var/www に設定
WORKDIR /var/www