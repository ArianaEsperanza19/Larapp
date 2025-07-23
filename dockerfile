# Usa una imagen base de PHP-FPM para Laravel (FPM es para Nginx)
FROM php:8.2-fpm

# Instala extensiones de PHP necesarias para Laravel
# y otras utilidades comunes
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libmariadb-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd opcache zip \
    && docker-php-ext-enable opcache

# Limpia los cachés de apt
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Establece el directorio de trabajo dentro del contenedor
# La práctica estándar para aplicaciones web es /var/www
WORKDIR /var/www

# ====================================================================
# ✨ CAMBIO CLAVE RESALTADO ✨
# Copia TODO el código de tu aplicación (incluyendo 'artisan')
# a /var/www DENTRO del contenedor.
# ¡ESTE PASO DEBE ESTAR ANTES de 'composer install'!
COPY . /var/www
# ====================================================================

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instala las dependencias de Composer.
# Ahora que el código completo de la aplicación está en /var/www,
# 'artisan' será accesible para los scripts de Composer.
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Configura permisos adecuados para Laravel (importante)
# www-data es el usuario por defecto de PHP-FPM en Debian/Ubuntu
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Exponer el puerto por si el PHP-FPM necesitara ser accedido directamente (Nginx lo manejará)
EXPOSE 9000

# El comando por defecto cuando el contenedor se inicia
# php-fpm maneja las peticiones para Nginx
CMD ["php-fpm"]
