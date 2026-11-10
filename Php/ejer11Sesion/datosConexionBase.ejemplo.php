<?php
/* Ejemplo del archivo datosConexionBase.php.
   Este archivo solo contiene los datos necesarios para conectarse al motor de la base de datos
   y debe ser incluido con un include(). Lo usan el manejador de sesión (autenticación) y,
   desde la carpeta de arriba, todos los scripts de appModulo1.

   El archivo real (datosConexionBase.php) NO se sube al repositorio: está en .gitignore.
   Para usarlo, copiar este archivo con ese nombre y completar los datos que da el proveedor. */

$dbname = "nombredelabasededatos";
$host = "nombredelhostqueproveeelmotordebasededatos";
$user = "nombredeusuario";
$password = "contraseniadelusuario";
?>
