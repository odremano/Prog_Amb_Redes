<?php
/* Para fines didácticos: tiempo muerto que simula la demora de la red. */
sleep(3);

/* Los datos recibidos por POST se pasan a un objeto de datos de PHP... */
$objNotaDebito = new stdClass();
$objNotaDebito->nroComprobante = $_POST['nroComprobante'];
$objNotaDebito->codCliente = $_POST['codCliente'];
$objNotaDebito->razonSocial = $_POST['razonSocial'];
$objNotaDebito->totalComprobante = $_POST['totalComprobante'];

/* ...y ese objeto se convierte a JSON con json_encode (no se escribe el JSON a mano). */
$jsonNotaDebito = json_encode($objNotaDebito);
echo $jsonNotaDebito;
?>
