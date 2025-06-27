# Usa la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instala extensiones necesarias de sistema y PHP
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpq-dev libonig-dev libxml2-dev \
    libfreetype6-dev libjpeg-dev libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        gd \
        bcmath \
        pdo_pgsql \
        pdo_mysql \
        zip \
        mbstring \
        xml \
    && a2enmod rewrite

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establece el directorio de trabajo en Apache
WORKDIR /var/www/html

# Copia todo el contenido del proyecto al contenedor
COPY . .

# Copia .env si no existe, instala dependencias y prepara Laravel
RUN cp .env.example .env \
    && composer install --no-interaction --no-dev --optimize-autoloader \
    && php artisan key:generate \
    && php artisan config:cache

# Asigna permisos necesarios para Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Copia la configuración personalizada de Apache (si tienes un archivo apache.conf)
COPY ./apache.conf /etc/apache2/sites-available/000-default.conf

# Expone el puerto HTTP por defecto
EXPOSE 80

# Comando por defecto al iniciar el contenedor
CMD ["apache2-foreground"]
