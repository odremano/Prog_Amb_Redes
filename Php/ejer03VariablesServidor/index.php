<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Variables de servidor</title>
<link rel="stylesheet" href="../estilo.css">
</head>
<body>

<h1>Variables de servidor</h1>

<p class="aclaracion">En este ejercicio se muestra el arreglo global $_SERVER, un arreglo de índice asociativo en el que cada índice describe el elemento. Sus variables se dividen en tres grupos: las del servidor, las del cliente (el navegador remoto) y las del requerimiento HTTP.</p>

<h2>Variables de servidor</h2>
<table class="clave-valor">
<?php
echo "<tr><td>SERVER_ADDR</td><td>" . $_SERVER['SERVER_ADDR'] . "</td></tr>";
echo "<tr><td>SERVER_PORT</td><td>" . $_SERVER['SERVER_PORT'] . "</td></tr>";
echo "<tr><td>SERVER_NAME</td><td>" . $_SERVER['SERVER_NAME'] . "</td></tr>";
echo "<tr><td>HTTP_HOST</td><td>" . $_SERVER['HTTP_HOST'] . "</td></tr>";
echo "<tr><td>DOCUMENT_ROOT</td><td>" . $_SERVER['DOCUMENT_ROOT'] . "</td></tr>";
?>
</table>

<h2>Variables de cliente</h2>
<table class="clave-valor">
<?php
echo "<tr><td>REMOTE_ADDR</td><td>" . $_SERVER['REMOTE_ADDR'] . "</td></tr>";
echo "<tr><td>REMOTE_PORT</td><td>" . $_SERVER['REMOTE_PORT'] . "</td></tr>";
?>
</table>

<h2>Variables de requerimiento</h2>
<table class="clave-valor">
<?php
echo "<tr><td>SERVER_PROTOCOL</td><td>" . $_SERVER['SERVER_PROTOCOL'] . "</td></tr>";
echo "<tr><td>SCRIPT_NAME</td><td>" . $_SERVER['SCRIPT_NAME'] . "</td></tr>";
echo "<tr><td>REQUEST_METHOD</td><td>" . $_SERVER['REQUEST_METHOD'] . "</td></tr>";
echo "<tr><td>REQUEST_URI</td><td>" . $_SERVER['REQUEST_URI'] . "</td></tr>";
echo "<tr><td>QUERY_STRING</td><td>" . $_SERVER['QUERY_STRING'] . "</td></tr>";
?>
</table>
<p class="aclaracion">Para probar QUERY_STRING agregue parámetros a la URL, por ejemplo: <code>?cliente=CLI001</code></p>

<h2>TODAS las variables</h2>
<p>Se barre el arreglo $_SERVER completo con un foreach: clave = valor.</p>
<table class="clave-valor">
<?php
foreach ($_SERVER as $clave => $valor) {
  echo "<tr><td>" . $clave . "</td><td>" . $valor . "</td></tr>";
}
?>
</table>

<p><a class="volver" href="../index.html">&larr; Volver al índice de PHP</a></p>

</body>
</html>
