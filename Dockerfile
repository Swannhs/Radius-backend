FROM php:7.3-fpm

WORKDIR /usr/share/nginx/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libicu-dev \
    libpq-dev \
    libmcrypt-dev \
    libpng-dev \
    libzip-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libxml2-dev \
    locales \
    git \
    zip \
    unzip \
    cron
    

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install \
    intl \
    mbstring \
    pcntl \
    pdo_mysql \
    zip \
    opcache \
    xml \
    gd

#install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

#set our application folder as an environment variable
ENV APP_HOME /usr/share/nginx/html/cake3/rd_cake

#change uid and gid of apache to docker user uid/gid
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

#copy source files and run composer
COPY ./ $APP_HOME

# install all PHP dependencies
RUN cd $APP_HOME && composer update

#change ownership of our applications
RUN mkdir -p  $APP_HOME/logs \
    && mkdir -p $APP_HOME/webroot/files/imagecache \
    && mkdir -p $APP_HOME/tmp

#Cake v3
RUN chown -R www-data. $APP_HOME/tmp \
    && chown -R www-data. $APP_HOME/logs \
    && chown -R www-data. $APP_HOME/webroot/img/realms \
    && chown -R www-data. $APP_HOME/webroot/img/dynamic_details \
    && chown -R www-data. $APP_HOME/webroot/img/dynamic_photos \
    && chown -R www-data. $APP_HOME/webroot/img/access_providers \
    && chown -R www-data. $APP_HOME/webroot/img/nas \
    && chown -R www-data. $APP_HOME/webroot/files/imagecache


RUN mkdir -p /etc/cron.d \
    && cp $APP_HOME/setup/cron/cron3 /etc/cron.d/

COPY ./entrypoint.sh /

RUN chmod -R 0755 /entrypoint.sh && \
  crontab /etc/cron.d/cron3 && \
  touch /var/log/cron.log

EXPOSE 9000
# CMD ["php-fpm"]
ENTRYPOINT /entrypoint.sh