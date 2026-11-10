<?php
/* Rompe la sesión del usuario. Como todos los demás scripts, está protegido en sesión:
   un acceso ilegal redirecciona al formulario de login. */

session_start();

if (!isset($_SESSION['identificativoDeSesion'])) {
  header('Location: ./formularioDeLogin.html');
  exit();
}

/* Termina la sesión de usuario borrando todas las variables asociadas */
session_destroy();

header('Location: ./formularioDeLogin.html');
exit();
?>
