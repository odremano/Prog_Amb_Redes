<?php
/* Recibe el login y la clave del formulario de login, autentica al usuario y crea la sesión.
   Este script no está protegido en sesión (es el que la crea), pero se encierra en un condicional
   que consulta si ya hay una sesión: así un reload de esta página no genera un nuevo proceso de
   autenticación (y no incrementa el contador de sesiones). */

require("./libreria.inc");

session_start();

if (!isset($_SESSION['identificativoDeSesion'])) {
  /* No hay sesión iniciada asociada al requerimiento http: autenticación y creación de sesión */

  $log = "";
  $cl = "";
  if (isset($_POST['login'])) { $log = $_POST['login']; }
  if (isset($_POST['clave'])) { $cl = $_POST['clave']; }

  if (!autenticacion($log, $cl)) {
    header('Location: ./formularioDeLogin.html');
    exit();
  }

  /* Se crea el nuevo identificativo de sesión y se define el estado de la aplicación para este usuario */
  $_SESSION['identificativoDeSesion'] = session_create_id();
  $_SESSION['login'] = $GLOBALS['datosUsuario']['login'];
  $_SESSION['apellido'] = $GLOBALS['datosUsuario']['apellido'];
  $_SESSION['nombres'] = $GLOBALS['datosUsuario']['nombres'];
  $_SESSION['ContadorDeSesion'] = $GLOBALS['datosUsuario']['contador'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ingreso al sistema</title>
<style>
  body { margin: 0; padding: 20px; font-family: Arial, sans-serif; background-color: #eef2f5; overflow-wrap: anywhere; }
  .caja { max-width: 640px; margin: 20px auto; padding: 22px; background-color: white; border: 1px solid #dde3e6; border-radius: 6px; }
  h1 { margin-top: 0; color: #2f5d62; }
  table { border-collapse: collapse; width: 100%; margin: 14px 0 20px 0; }
  td { border: 1px solid #b9c5c8; padding: 8px 10px; }
  td:first-child { background-color: #eef5f4; font-weight: bold; width: 40%; }
  button { padding: 10px 16px; margin: 4px 6px 4px 0; font-size: 15px; cursor: pointer; border: 1px solid #2f5d62; border-radius: 4px; background-color: #2f5d62; color: white; }
  button.salida { background-color: white; color: #2f5d62; }
</style>
</head>
<body>

  <div class="caja">
    <h1>Ingreso al sistema</h1>
    <h2>Sus parámetros de sesión son los siguientes:</h2>

    <?php infoDeSesion(); ?>

    <button type="button" id="btAppModulo1">Ingresar a la aplicación</button>
    <button type="button" id="btSalida" class="salida">Abandonar la sesión</button>
  </div>

  <script>
    document.getElementById("btAppModulo1").addEventListener("click", function() {
      location.href = "./appModulo1/index.php";
    });
    document.getElementById("btSalida").addEventListener("click", function() {
      location.href = "./destruirSesion.php";
    });
  </script>

</body>
</html>
