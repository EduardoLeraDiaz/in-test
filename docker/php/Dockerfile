FROM php:8.1-fpm as dev

WORKDIR /app

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    vim \
    curl \
    sudo \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    libonig-dev \
    nodejs \
    npm

RUN docker-php-ext-install ctype iconv session mbstring

COPY --from=composer /usr/bin/composer /usr/bin/composer

# Manage user
ARG UID=1001
ARG GID=1001
RUN echo $GID
RUN groupadd --gid $GID appuser
RUN useradd -r -u $UID -g appuser appuser
RUN echo '%appuser ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

RUN mkdir -p /home/appuser
RUN chown appuser:appuser /home/appuser

USER appuser


