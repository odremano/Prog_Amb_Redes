<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PHP include</title>
<link rel="stylesheet" href="../estilo.css">
</head>
<body>

<h1>Función include()</h1>

<p class="aclaracion">En este ejemplo se utiliza la función include(), que ubica código PHP definido en otro archivo, en este caso asignaciones.php. Ese archivo declara y asigna dos arreglos asociativos con dos notas de débito. Si se intenta imprimirlos antes del include, PHP muestra warnings porque las variables todavía no existen, pero el script no se cancela: sigue ejecutándose hasta el final.</p>

<h2>Antes del include</h2>
<p>Las variables $aNota1 y $aNota2 todavía no fueron declaradas:</p>
<table class="clave-valor">
<?php
foreach ($aNota1 as $clave => $valor) {
  echo "<tr><td>" . $clave . "</td><td>" . $valor . "</td></tr>";
}
foreach ($aNota2 as $clave => $valor) {
  echo "<tr><td>" . $clave . "</td><td>" . $valor . "</td></tr>";
}
?>
</table>

<?php
include("./asignaciones.php");
?>

<h2>Después del include</h2>
<p>Ahora sí las variables existen y se imprimen los dos arreglos asociativos:</p>
<table class="clave-valor">
<?php
foreach ($aNota1 as $clave => $valor) {
  echo "<tr><td>" . $clave . "</td><td>" . $valor . "</td></tr>";
}
?>
</table>
<table class="clave-valor">
<?php
foreach ($aNota2 as $clave => $valor) {
  echo "<tr><td>" . $clave . "</td><td>" . $valor . "</td></tr>";
}
?>
</table>

<p>La longitud de $aNota1 es: <?php echo count($aNota1); ?></p>
<p>La longitud de $aNota2 es: <?php echo count($aNota2); ?></p>

<p><a class="volver" href="../index.html">&larr; Volver al índice de PHP</a></p>

</body>
</html>
