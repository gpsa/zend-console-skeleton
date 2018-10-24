ARG P_CONTAINER_VERSION=7.2-zts

FROM php:${P_CONTAINER_VERSION}


ARG P_RUN_UID=1000
ARG P_RUN_GID=1000
ARG P_RUN_USER=web
ARG P_RUN_GROUP=web
ARG P_COMPOSER_HOME=/home/${P_RUN_USER}/.composer
ARG P_WORKDIR=/home/${P_RUN_USER}/www

ENV WORKDIR=${P_WORKDIR}
ENV COMPOSER_HOME=${P_COMPOSER_HOME}

ENV RUN_USER=${P_RUN_USER}
ENV RUN_GROUP=${P_RUN_USER}
ENV RUN_UID=${P_RUN_UID}
ENV RUN_GID=${P_RUN_GID}

# Add global composer bin dir to PATH
ENV PATH $COMPOSER_HOME/vendor/bin:$PATH



LABEL maintainer="Guilherme Alves <guilhermepsa@gmail.com>"

# COPY config/php.ini /usr/local/etc/php/

# Extensions
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    zlib1g-dev \
    libpng-dev \
    libpq-dev \
    libssl-dev \
    libxml2-dev \
    libmemcached-dev \
    wget \
    git

RUN pecl install \
        mongodb \
        redis \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) \
        gd \
        iconv \
        bcmath \
        mysqli \
        pcntl \
        pdo_mysql \
        zip \
        sockets \
        soap \
    && docker-php-ext-enable \
        opcache \
        mongodb \
        redis

# Add PHP Pthreads module
# Build from source
# Borowed from https://github.com/bscheshirwork/multispider/blob/master/zts/Dockerfile
RUN git clone https://github.com/krakjoe/pthreads.git \
        && ( \
            cd pthreads \
            && phpize \
            && ./configure --enable-pthreads \
            && make -j$(nproc) \
            && make install \
        ) \
        && rm -r pthreads \
        && docker-php-ext-enable pthreads

# Composer
RUN php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && chmod +x composer.phar \
    && mv composer.phar /usr/bin/composer

# Memory Limit
RUN echo "memory_limit=256M" > $PHP_INI_DIR/conf.d/memory-limit.ini

# Time Zone
RUN echo "date.timezone=America/Sao_Paulo" > $PHP_INI_DIR/conf.d/date_timezone.ini

# Cria grupo 1000
RUN getent group $RUN_GID || groupadd $RUN_USER -g $RUN_UID

# Cria usuario 1000
RUN getent passwd $RUN_UID || adduser --uid $RUN_UID --gid $RUN_GID --disabled-password --gecos "" $RUN_USER

RUN usermod -a -G $RUN_USER www-data


# PHP ERROR_LOG
RUN touch /var/log/php.log && chown $RUN_USER:www-data /var/log/php.log
RUN echo "log_errors=On \n error_log = /var/log/php.log" > $PHP_INI_DIR/conf.d/error_log.ini

RUN  mkdir -p $WORKDIR $COMPOSER_HOME

# OWNER
RUN chown -R $RUN_USER:www-data $COMPOSER_HOME
RUN chown -R $RUN_USER:www-data $WORKDIR

WORKDIR $WORKDIR
USER $RUN_USER
ENTRYPOINT tail -f /var/log/php.log
