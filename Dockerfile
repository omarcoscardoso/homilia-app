FROM php:8.2-fpm as builder

RUN apt-get update && \
    apt-get install -y \
        nginx \
        git \
        unzip \
        libzip-dev \
        libonig-dev \
        libpq-dev \
        nodejs \
        npm \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql zip mbstring exif pcntl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build

# Segundo estágio: Imagem final, mais leve para produção.
FROM php:8.2-fpm

RUN apt-get update && \
    apt-get install -y \
        nginx \
        libpq-dev \
    && rm -rf /var/lib/apt/lists/*

RUN mkdir -p /var/www/html

COPY --from=builder /var/www/html /var/www/html

RUN chown -R www-data:www-data /var/www/html/storage
RUN chmod -R 775 /var/www/html/storage
RUN chown -R www-data:www-data /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/bootstrap/cache

# Copia as configurações do Nginx e o script de inicialização
COPY .docker/nginx.conf /etc/nginx/sites-available/default
RUN ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default
COPY .docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 80
CMD ["/usr/local/bin/start.sh"]
