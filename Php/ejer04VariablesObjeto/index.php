<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Variables tipo objeto</title>
<link rel="stylesheet" href="../estilo.css">
</head>
<body>

<h1>Variables tipo objeto en PHP: encabezados de notas de débito</h1>

<p class="aclaracion">Igual que en los ejercicios especiales con JSON del lado del cliente, acá el servidor arma el objeto nota de débito con stdClass, lo suma a un arreglo, arma un objeto contenedor y lo codifica como texto JSON con json_encode. Ese texto es el que luego podría reemplazar al archivo .js con el JSON escrito a mano.</p>

<?php
/* ---------- 1) Un objeto nota de débito ---------- */
$objNota = new stdClass();
$objNota->nroComprobante = "ND-0001";
$objNota->nroFacturaImputada = "FA-0101";
$objNota->codigoTipo = "01";
$objNota->codCliente = "CLI001";
$objNota->razonSocial = "Distribuidora Norte S.A.";
$objNota->fechaComprobante = "2026-03-05";
$objNota->totalComprobante = 12500;
?>

<h2>1) Un objeto nota de débito</h2>
<table class="clave-valor">
<?php
foreach ($objNota as $atributo => $valor) {
  echo "<tr><td>" . $atributo . "</td><td>" . $valor . "</td><td>" . gettype($valor) . "</td></tr>";
}
?>
</table>
<p>Tipo de $objNota: <b><?php echo gettype($objNota); ?></b></p>

<?php
/* ---------- 2) Un arreglo de objetos ---------- */
$aNotasDebito = [];
array_push($aNotasDebito, $objNota);

$objNota2 = new stdClass();
$objNota2->nroComprobante = "ND-0002";
$objNota2->nroFacturaImputada = "FA-0108";
$objNota2->codigoTipo = "02";
$objNota2->codCliente = "CLI002";
$objNota2->razonSocial = "Ferretería El Tornillo S.R.L.";
$objNota2->fechaComprobante = "2026-03-12";
$objNota2->totalComprobante = 3400;
array_push($aNotasDebito, $objNota2);

$objNota3 = new stdClass();
$objNota3->nroComprobante = "ND-0003";
$objNota3->nroFacturaImputada = "FA-0115";
$objNota3->codigoTipo = "03";
$objNota3->codCliente = "CLI003";
$objNota3->razonSocial = "Supermercados Del Plata S.A.";
$objNota3->fechaComprobante = "2026-03-28";
$objNota3->totalComprobante = 48000;
array_push($aNotasDebito, $objNota3);
?>

<h2>2) Un arreglo de notas de débito</h2>
<p>Tipo de $aNotasDebito: <b><?php echo gettype($aNotasDebito); ?></b>. Se recorre con foreach y se tabula con HTML:</p>
<table>
  <tr>
    <th>Nro. comprobante</th>
    <th>Factura imputada</th>
    <th>Tipo</th>
    <th>Cliente</th>
    <th>Razón social</th>
    <th>Fecha</th>
    <th>Total</th>
  </tr>
<?php
foreach ($aNotasDebito as $objNotaDebito) {
  echo "<tr>";
  echo "<td>" . $objNotaDebito->nroComprobante . "</td>";
  echo "<td>" . $objNotaDebito->nroFacturaImputada . "</td>";
  echo "<td>" . $objNotaDebito->codigoTipo . "</td>";
  echo "<td>" . $objNotaDebito->codCliente . "</td>";
  echo "<td>" . $objNotaDebito->razonSocial . "</td>";
  echo "<td>" . $objNotaDebito->fechaComprobante . "</td>";
  echo "<td>" . $objNotaDebito->totalComprobante . "</td>";
  echo "</tr>";
}
?>
</table>
<p>Cantidad de notas de débito: <b><?php echo count($aNotasDebito); ?></b></p>

<?php
/* ---------- 3) Objeto contenedor ---------- */
$objNotasDebito = new stdClass();
$objNotasDebito->notasDebito = $aNotasDebito;
$objNotasDebito->cantidadDeNotas = count($aNotasDebito);
?>

<h2>3) Un objeto contenedor</h2>
<p>$objNotasDebito tiene dos propiedades: el arreglo notasDebito (tipo <?php echo gettype($objNotasDebito->notasDebito); ?>) y cantidadDeNotas (tipo <?php echo gettype($objNotasDebito->cantidadDeNotas); ?>), que vale <b><?php echo $objNotasDebito->cantidadDeNotas; ?></b>.</p>

<?php
/* ---------- 4) Codificación a JSON ---------- */
$jsonNotasDebito = json_encode($objNotasDebito);
?>

<h2>4) Producción del JSON</h2>
<p>Resultado de json_encode($objNotasDebito), el texto que el servidor enviaría al navegador remoto:</p>
<pre><?php echo $jsonNotasDebito; ?></pre>

<p><a class="volver" href="../index.html">&larr; Volver al índice de PHP</a></p>

</body>
</html>
