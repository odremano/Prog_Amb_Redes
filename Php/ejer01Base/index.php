<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PHP base</title>
<link rel="stylesheet" href="../estilo.css">
</head>
<body>

<h1>PHP base</h1>

<p class="aclaracion">Este primer texto está escrito fuera de las marcas de PHP: el procesador lo envía tal cual al navegador remoto, sin procesarlo.</p>

<hr>

<?php
/* Marca de comentario de varias líneas: todo lo que sigue es código PHP
   que el servidor interpreta antes de responder. */
// Comentario al final de una línea.
# Otra forma de comentar en PHP.

echo "<p class='aclaracion'>Este texto HTML sale de adentro de las marcas de PHP, como argumento de un echo. Las comillas simples internas evitan cortar el string externo.</p>";

/* ---------- Variables simples ---------- */
echo "<h2>Variables simples</h2>";

$nroComprobante = "ND-0001";
echo "<p>El valor de <span class='nombre'>\$nroComprobante</span> es: <span class='valor'>" . $nroComprobante . "</span></p>";
echo "<p>El tipo de <span class='nombre'>\$nroComprobante</span> es: " . gettype($nroComprobante) . "</p>";

$neto = 10000;
$iva = 2100;
echo "<p>El valor de <span class='nombre'>\$neto</span> es: " . $neto . " y su tipo es: " . gettype($neto) . "</p>";
echo "<p>El valor de <span class='nombre'>\$iva</span> es: " . $iva . " y su tipo es: " . gettype($iva) . "</p>";

$total = ($neto + $iva);
echo "<p class='consigna'>\$total es la suma de \$neto y \$iva. Si los tipos fueran diferentes PHP devolvería error.</p>";
echo "<p>El valor de <span class='nombre'>\$total</span> es: " . $total . " y su tipo es: " . gettype($total) . "</p>";

$estaAnulada = true;
echo "<p>Variable lógica (verdadero) <span class='nombre'>\$estaAnulada</span> = " . $estaAnulada . " (true se imprime como 1). Tipo: " . gettype($estaAnulada) . "</p>";
$estaAnulada = false;
echo "<p>Variable lógica (falso) <span class='nombre'>\$estaAnulada</span> = " . $estaAnulada . " (false se imprime vacío). Tipo: " . gettype($estaAnulada) . "</p>";

define("EMPRESA", "Distribuidora Odreman S.A.");
echo "<p>La constante <span class='nombre'>EMPRESA</span> vale: " . EMPRESA . " (las constantes no llevan \$). Tipo: " . gettype(EMPRESA) . "</p>";

/* ---------- Arreglo de índice numérico ---------- */
echo "<h2>Arreglo de índice numérico</h2>";

$aTiposNota = ["Diferencia de Cambio", "Ajuste por retardo en el pago"];
echo "<p>Los dos primeros elementos se cargan en la declaración. \$aTiposNota[0] = " . $aTiposNota[0] . " y \$aTiposNota[1] = " . $aTiposNota[1] . "</p>";

array_push($aTiposNota, "Agregado de producto");
array_push($aTiposNota, "Cambio en Alícuota IVA");
echo "<p>Los dos siguientes se agregan con array_push. Tipo de \$aTiposNota: " . gettype($aTiposNota) . ". Se recorre con foreach:</p>";
echo "<ul>";
foreach ($aTiposNota as $tipo) {
  echo "<li>" . $tipo . "</li>";
}
echo "</ul>";
echo "<p>Cantidad de elementos: " . count($aTiposNota) . "</p>";

/* ---------- Arreglo de dos dimensiones ---------- */
echo "<h2>Arreglo de dos dimensiones (diccionario)</h2>";

$aDiccionario = [
  ["Español", "Inglés", "Portugués"],
  ["Factura", "Invoice", "Fatura"],
  ["Cliente", "Customer", "Cliente"],
  ["Saldo", "Balance", "Saldo"]
];

echo "<table>";
foreach ($aDiccionario as $indiceFila => $aFila) {
  echo "<tr>";
  foreach ($aFila as $palabra) {
    if ($indiceFila == 0) {
      echo "<th>" . $palabra . "</th>";
    } else {
      echo "<td>" . $palabra . "</td>";
    }
  }
  echo "</tr>";
}
echo "</table>";
echo "<p>El elemento \$aDiccionario[2][1] es: <b>" . $aDiccionario[2][1] . "</b></p>";
echo "<p>Cantidad de filas del diccionario (con el encabezado): " . count($aDiccionario) . "</p>";

/* ---------- Arreglo asociativo ---------- */
echo "<h2>Arreglo de índice asociativo</h2>";

$aNotaDebito = [
  "nroComprobante" => "ND-0002",
  "razonSocial" => "Ferretería El Tornillo S.R.L.",
  "fechaComprobante" => "2026-03-12",
  "totalComprobante" => 3400
];

echo "<table class='clave-valor'>";
foreach ($aNotaDebito as $clave => $valor) {
  echo "<tr><td>" . $clave . "</td><td>" . $valor . "</td><td>" . gettype($valor) . "</td></tr>";
}
echo "</table>";
echo "<p>Cantidad de elementos del arreglo: " . count($aNotaDebito) . ". Tipo de datos del arreglo: " . gettype($aNotaDebito) . "</p>";

/* ---------- Expresiones aritméticas ---------- */
echo "<h2>Expresiones aritméticas</h2>";

$x = 7;
$y = 2;
$suma = ($x + $y);
$producto = $x * $y;
$cociente = $x / $y;
echo "<p>\$x = " . $x . " y \$y = " . $y . "</p>";
echo "<p>Suma: " . $suma . " (tipo " . gettype($suma) . ")</p>";
echo "<p>Multiplicación: " . $producto . " (tipo " . gettype($producto) . ")</p>";
echo "<p>División: " . $cociente . " (tipo " . gettype($cociente) . ", porque la división no es exacta)</p>";

/* ---------- Alcance de las variables ---------- */
echo "<h2>Alcance de las variables</h2>";

$n1 = 40;
$n2 = 50;
echo "<p class='aclaracion'>Las variables declaradas fuera de toda función son globales: PHP las guarda en el arreglo asociativo \$GLOBALS, cuyo índice es el nombre de cada variable.</p>";
echo "<p>\$GLOBALS['n1'] = " . $GLOBALS['n1'] . " y \$GLOBALS['n2'] = " . $GLOBALS['n2'] . "</p>";
echo "<p>Suma tomada desde el arreglo global: " . ($GLOBALS['n1'] + $GLOBALS['n2']) . "</p>";

function mostrarVariableLocal() {
  $variableLocal = "Solo existo adentro de la función";
  echo "<p>Dentro de la función: " . $variableLocal . "</p>";
}
mostrarVariableLocal();
echo "<p class='aclaracion'>Una variable declarada dentro de una función tiene alcance local: no es válida fuera de ella.</p>";
?>

<p><a class="volver" href="../index.html">&larr; Volver al índice de PHP</a></p>

</body>
</html>
