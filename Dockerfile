FROM php:7.2-apache

COPY . /var/www/html/coslem

RUN apt-get update

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libzip-dev \
    libxslt1-dev \
    unzip \
    unzip \ 
    iputils-ping \
    sudo

# Install required PHP extensions
RUN docker-php-ext-install \
    gd \
    intl \
    xsl \
    mbstring \
    pdo_mysql \
    mysqli \
    xsl \
    zip \
    soap

RUN a2enmod rewrite

COPY codeigniter.conf /etc/apache2/sites-available/
RUN a2dissite 000-default.conf && a2ensite codeigniter.conf

EXPOSE 80
CMD ["apache2-foreground"]