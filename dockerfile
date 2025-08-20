# Usamos una imagen base de PHP oficial de Docker
FROM php:8.1-fpm-alpine

# Instalamos las dependencias del sistema necesarias
RUN apk add --no-cache libzip-dev libpng-dev libjpeg-turbo-dev libwebp-dev \
    && docker-php-ext-configure gd --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql mysqli opcache \
    && docker-php-ext-enable opcache \
    && rm -rf /var/cache/apk/*

# Copia los archivos de Composer y el proyecto
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . /var/www/html/

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Instala las dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Publica la configuración de Laravel
RUN php artisan config:cache

# Expone el puerto 9000 para PHP-FPM
EXPOSE 9000

# Comando para iniciar la aplicación (se ejecutará al desplegar)
CMD ["php-fpm"]
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Exponer el puerto por si el PHP-FPM necesitara ser accedido directamente (Nginx lo manejará)
EXPOSE 9000

# El comando por defecto cuando el contenedor se inicia
# php-fpm maneja las peticiones para Nginx
CMD ["php-fpm"]
