# Imagen con Apache + PHP para servir todo el sitio (HTML/CSS/JS estáticos y los ejercicios .php)
FROM php:8-apache

# Extensión PDO para MySQL (acceso a la base de datos desde PHP)
RUN docker-php-ext-install pdo_mysql

COPY . /var/www/html/

# Los archivos .log y .sql no se entregan nunca por HTTP (pueden contener datos del servidor)
RUN printf '<FilesMatch "\\.(log|sql)$">\n  Require all denied\n</FilesMatch>\n' > /etc/apache2/conf-available/proteger-archivos.conf \
    && a2enconf proteger-archivos

# errores.log de cada ejercicio con base de datos: PHP (www-data) necesita poder escribirlo
RUN touch /var/www/html/Php/ejer09DbListaOrdenaFiltra/errores.log \
    && chown www-data:www-data /var/www/html/Php/ejer09DbListaOrdenaFiltra/errores.log
