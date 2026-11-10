<?php
/* Puerta de entrada a la aplicación. Se ejecuta desde la primera línea:
   si no hay sesión establecida, redirecciona al formulario de login;
   si la hay, presenta los datos de la sesión y los controles para entrar a la aplicación o abandonarla. */

require("./libreria.inc");

session_start();

if (!isset($_SESSION['identificativoDeSesion'])) {
  header('Location: ./formularioDeLogin.html');
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sesión</title>
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
    <h1>Usted está en sesión</h1>
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
