# Usa imagen oficial PHP con Apache
FROM php:8.1-apache

# Instala dependencias del sistema y extensiones PHP necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpq-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_pgsql pdo_mysql zip mbstring xml \
    && a2enmod rewrite

# Instala Composer (usa imagen oficial de Composer para copiar binario)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia todo el proyecto al directorio raíz del servidor Apache
COPY . /var/www/html/

# Cambia permisos para carpetas de almacenamiento y caché
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Ejecuta Composer para instalar dependencias PHP (sin dev y optimizado)
RUN composer install --no-dev --optimize-autoloader

# Copia configuración Apache personalizada para Laravel
COPY ./apache.conf /etc/apache2/sites-available/000-default.conf

# Expone el puerto 80 para HTTP
EXPOSE 80

# Comando para iniciar Apache en primer plano
CMD ["apache2-foreground"]
