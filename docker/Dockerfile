FROM php:8.0-apache 
RUN apt-get update \
	&& apt-get install -y libzip-dev \
	&& apt-get install -y zlib1g-dev \
	&& rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
RUN a2enmod autoindex
