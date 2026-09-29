# Imagen con Apache + PHP para servir todo el sitio (HTML/CSS/JS estáticos y los ejercicios .php)
FROM php:8-apache

COPY . /var/www/html/
