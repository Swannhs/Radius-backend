FROM php:7.4-fpm

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

#RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install \
    intl \
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

# create symbolink
#RUN ln -s $APP_SRC/cake3 ./cake3

RUN cp $APP_HOME/local.ini /usr/local/etc/php/conf.d/local.ini

# install all PHP dependencies
RUN cd $APP_HOME && composer update

# create required directories
RUN mkdir -p  $APP_HOME/logs \
    && mkdir -p $APP_HOME/tmp \
    && mkdir -p $APP_HOME/webroot/files/imagecache

#change ownership of our applications
#Cake v3
RUN chown -R www-data. $APP_HOME/tmp \
    && chown -R www-data. $APP_HOME/logs \
    && chown -R www-data. $APP_HOME/webroot/img/realms \
    && chown -R www-data. $APP_HOME/webroot/img/dynamic_details \
    && chown -R www-data. $APP_HOME/webroot/img/dynamic_photos \
    && chown -R www-data. $APP_HOME/webroot/img/access_providers \
    && chown -R www-data. $APP_HOME/webroot/img/nas \
    && chown -R www-data. $APP_HOME/webroot/files/imagecache

#Install corn jobs for radiusdesk related stuffs
RUN mkdir -p /etc/cron.d \
    && cp $APP_HOME/setup/cron/cron3 /etc/cron.d/

COPY ./entrypoint.sh /

RUN chmod -R 0755 /entrypoint.sh && \
  crontab /etc/cron.d/cron3 && \
  touch /var/log/cron.log

# Move dictionary files to proper directories for profile component
# See: cake2/rd_cake/Config/RadiusDesk.php
RUN mkdir -p /etc/freeradius/3.0 \
    && mv $APP_HOME/freeradius/* /etc/freeradius/3.0/ \
    && mkdir -p /usr/share/freeradius \
    && mv /etc/freeradius/3.0/dictionaries/* /usr/share/freeradius/ \
    && rm -rf /etc/freeradius/3.0/dictionaries

RUN chown -R www-data. /etc/freeradius/3.0 \
    && chown -R www-data. /usr/share/freeradius

EXPOSE 9000
# CMD ["php-fpm"]
ENTRYPOINT /entrypoint.sh