# Usamos una imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instalamos dependencias necesarias para Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Habilitar mod_rewrite de Apache (necesario para rutas en Laravel)
RUN a2enmod rewrite

# Copiamos los archivos del proyecto al contenedor
WORKDIR /var/www/html
COPY . .

# Instalar Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Instalamos dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Establecer permisos de las carpetas necesarias
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Configuración de Apache para permitir .htaccess de Laravel
RUN echo "<Directory /var/www/html>\n\
    AllowOverride All\n\
</Directory>" >> /etc/apache2/apache2.conf

# Puerto expuesto (Render lo usa automáticamente)
EXPOSE 80

# Comando de inicio
CMD ["apache2-foreground"]
