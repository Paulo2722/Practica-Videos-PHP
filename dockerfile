# Usamos la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Activamos mod_rewrite de Apache
RUN a2enmod rewrite

# Instalamos extensiones necesarias de PHP (si necesitas más, se pueden agregar)
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copiamos el contenido de tu proyecto dentro del contenedor
# Ajusta la ruta si tu proyecto no está directamente en ./websites
COPY ./ /var/www/html/

# Establecemos permisos para que Apache pueda escribir en ciertos directorios si es necesario
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configuramos AllowOverride All para que funcione .htaccess
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Exponemos el puerto 80
EXPOSE 80

# Comando por defecto para Apache en primer plano
CMD ["apache2-foreground"]