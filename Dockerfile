# Imagen con Apache + PHP para servir todo el sitio (HTML/CSS/JS estáticos y los ejercicios .php)
FROM php:8-apache

# Extensión PDO para MySQL (acceso a la base de datos desde PHP)
RUN docker-php-ext-install pdo_mysql

# Tamaño máximo de los files que se suben desde los formularios (documentos pdf del ABM)
# y cookie de sesión no accesible desde JavaScript, que solo acepta identificativos creados por el servidor
RUN printf 'upload_max_filesize=10M\npost_max_size=12M\nsession.cookie_httponly=1\nsession.use_strict_mode=1\n' > /usr/local/etc/php/conf.d/subidas.ini

COPY . /var/www/html/

# Los archivos .log, .sql e .inc no se entregan nunca por HTTP (el servidor entregaría su código como texto)
RUN printf '<FilesMatch "\\.(log|sql|inc)$">\n  Require all denied\n</FilesMatch>\n' > /etc/apache2/conf-available/proteger-archivos.conf \
    && a2enconf proteger-archivos

# errores.log de cada ejercicio con base de datos: PHP (www-data) necesita poder escribirlo
RUN touch /var/www/html/Php/ejer09DbListaOrdenaFiltra/errores.log \
    && chown www-data:www-data /var/www/html/Php/ejer09DbListaOrdenaFiltra/errores.log \
    && touch /var/www/html/Php/ejer10Abm/errores.log \
    && chown www-data:www-data /var/www/html/Php/ejer10Abm/errores.log \
    && touch /var/www/html/Php/ejer11Sesion/errores.log \
    && chown www-data:www-data /var/www/html/Php/ejer11Sesion/errores.log \
    && touch /var/www/html/Php/ejer11Sesion/appModulo1/errores.log \
    && chown www-data:www-data /var/www/html/Php/ejer11Sesion/appModulo1/errores.log
