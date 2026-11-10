<?php
/* Protección en sesión de los scripts de la aplicación.
   Este código se incluye con un include() en la primera línea de cada script de la aplicación.

   session_start() lee el identificativo de sesión que el navegador envía en la cookie de cada
   requerimiento y ubica el arreglo $_SESSION que corresponde a ese usuario.
   Solo pasa a la ejecución del script que lo incluyó el usuario que está en sesión;
   de lo contrario redirecciona al index.php del manejador de sesión y termina. */

session_start();

if (!isset($_SESSION['identificativoDeSesion'])) {
  header('Location: ../index.php');
  exit();
}
?>
