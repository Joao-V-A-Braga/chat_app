# Use a imagem oficial do PHP 8.2
FROM php:8.2-fpm

WORKDIR /var/www/app

# Instale as extensões PHP necessárias
RUN docker-php-ext-install pdo pdo_mysql

# Instale o Composer globalmente
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

# Instale algumas extensões que o Laravel precisa
RUN apt-get update && apt-get install -y libzip-dev zip unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Configure o PHP para exibir erros
RUN echo "display_errors=On" >> /usr/local/etc/php/php.ini
RUN echo "error_reporting=E_ALL" >> /usr/local/etc/php/php.ini

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/app

RUN chown www:www-data -R /var/www/app
RUN chmod 755 -R /var/www/app
RUN chmod g+s -R  /var/www/app

# Change current user to www
USER www

# Exponhe a porta 8002 para o websocket
EXPOSE 8002

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
