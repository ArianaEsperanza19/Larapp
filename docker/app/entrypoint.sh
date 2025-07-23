#!/bin/sh
set -e

echo "Setting permissions for Laravel storage and cache..."
# Establece el propietario y los permisos correctos para los directorios de Laravel
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache
echo "Permissions set. Starting PHP-FPM..."

# Ejecuta el comando principal de PHP-FPM que está definido en el Dockerfile
exec php-fpm
