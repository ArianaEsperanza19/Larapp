# Usamos una imagen base de PHP oficial de Docker
FROM php:8.2-fpm-alpine

# Instalamos las dependencias del sistema necesarias
RUN apk add --no-cache libzip-dev libpng-dev libjpeg-turbo-dev libwebp-dev \
    && docker-php-ext-configure gd --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql mysqli opcache \
    && docker-php-ext-enable opcache \
    && rm -rf /var/cache/apk/*

RUN apk add --no-cache mysql-client

# Copia los archivos de Composer y el proyecto
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . /var/www/html/

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Instala las dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# 💥 NUEVO PASO: Ejecuta las migraciones de la base de datos
RUN php artisan migrate --force

# Limpia y optimiza la configuración de Laravel
RUN php artisan config:clear
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Otorga permisos de escritura a los directorios de almacenamiento y caché
RUN chmod -R 775 storage
RUN chmod -R 775 bootstrap/cache

# Expone el puerto 9000 para PHP-FPM
EXPOSE 9000

# El comando de inicio del contenedor usa php-fpm
CMD ["php-fpm"]
