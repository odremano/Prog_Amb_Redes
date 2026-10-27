<?php
/* Devuelve en JSON las notas de débito, con el orden y los filtros pedidos por el cliente. */

sleep(3); // Para fines didácticos: simula la demora de la red

include("./datosConexionBase.php"); // $dbname, $host, $user, $password
require("./logErrores.php");

/* ---------- 1) Recepción de las variables del requerimiento ---------- */
$orden = "nroComprobante";
$f_notasDebito_nroComprobante = "";
$f_notasDebito_nroFacturaImputada = "";
$f_notasDebito_tipoComprobante = "";
$f_notasDebito_codCliente = "";
$f_notasDebito_razonSocial = "";
$f_notasDebito_fechaComprobante = "";

if (isset($_POST['orden'])) { $orden = $_POST['orden']; }
if (isset($_POST['f_notasDebito_nroComprobante'])) { $f_notasDebito_nroComprobante = $_POST['f_notasDebito_nroComprobante']; }
if (isset($_POST['f_notasDebito_nroFacturaImputada'])) { $f_notasDebito_nroFacturaImputada = $_POST['f_notasDebito_nroFacturaImputada']; }
if (isset($_POST['f_notasDebito_tipoComprobante'])) { $f_notasDebito_tipoComprobante = $_POST['f_notasDebito_tipoComprobante']; }
if (isset($_POST['f_notasDebito_codCliente'])) { $f_notasDebito_codCliente = $_POST['f_notasDebito_codCliente']; }
if (isset($_POST['f_notasDebito_razonSocial'])) { $f_notasDebito_razonSocial = $_POST['f_notasDebito_razonSocial']; }
if (isset($_POST['f_notasDebito_fechaComprobante'])) { $f_notasDebito_fechaComprobante = $_POST['f_notasDebito_fechaComprobante']; }

/* El nombre de una columna no se puede vincular con bindParam: solo se acepta
   uno de los nombres de la tabla, cualquier otro valor se reemplaza por el orden por defecto. */
$aColumnasOrden = [
  "nroComprobante" => "nroComprobante",
  "nroFacturaImputada" => "nroFacturaImputada",
  "tipoComprobante" => "tipoComprobante",
  "codCliente" => "codCliente",
  "razonSocial" => "razonSocial",
  "fechaComprobante" => "fechaComprobante",
  "totalComprobante" => "totalComprobante"
];
if (!isset($aColumnasOrden[$orden])) {
  $orden = "nroComprobante";
}

$respuesta_estado = "";
$notasDebito = [];

try {
  /* ---------- 2) Apertura de la conexión con el motor ---------- */
  $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
  $dbh = new PDO($dsn, $user, $password); /* Database Handler */
  $respuesta_estado = $respuesta_estado . "conexion exitosa";

  /* ---------- 3) Asignación de la consulta SQL a una variable ---------- */
  $sql = "select idNotaDebito, nroComprobante, nroFacturaImputada, tipoComprobante, codCliente, razonSocial, fechaComprobante, totalComprobante, (adjunto IS NOT NULL) as tieneAdjunto from NotaDebito where ";
  $sql = $sql . "nroComprobante LIKE CONCAT('%',:nroComprobante,'%') and ";
  $sql = $sql . "nroFacturaImputada LIKE CONCAT('%',:nroFacturaImputada,'%') and ";
  $sql = $sql . "tipoComprobante LIKE CONCAT('%',:tipoComprobante,'%') and ";
  $sql = $sql . "codCliente LIKE CONCAT('%',:codCliente,'%') and ";
  $sql = $sql . "razonSocial LIKE CONCAT('%',:razonSocial,'%') and ";
  $sql = $sql . "fechaComprobante LIKE CONCAT('%',:fechaComprobante,'%')";
  $sql = $sql . " ORDER BY " . $aColumnasOrden[$orden];

  /* ---------- 4) Preparación, vinculación y ejecución de la sentencia ---------- */
  $stmt = $dbh->prepare($sql);

  $stmt->bindParam(':nroComprobante', $f_notasDebito_nroComprobante);
  $stmt->bindParam(':nroFacturaImputada', $f_notasDebito_nroFacturaImputada);
  $stmt->bindParam(':tipoComprobante', $f_notasDebito_tipoComprobante);
  $stmt->bindParam(':codCliente', $f_notasDebito_codCliente);
  $stmt->bindParam(':razonSocial', $f_notasDebito_razonSocial);
  $stmt->bindParam(':fechaComprobante', $f_notasDebito_fechaComprobante);

  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $stmt->execute();

  /* ---------- 5) Construcción de la respuesta en variables de tipo objeto ---------- */
  while ($fila = $stmt->fetch()) {
    $objNotaDebito = new stdClass();
    $objNotaDebito->idNotaDebito = $fila['idNotaDebito'];
    $objNotaDebito->nroComprobante = $fila['nroComprobante'];
    $objNotaDebito->nroFacturaImputada = $fila['nroFacturaImputada'];
    $objNotaDebito->tipoComprobante = $fila['tipoComprobante'];
    $objNotaDebito->codCliente = $fila['codCliente'];
    $objNotaDebito->razonSocial = $fila['razonSocial'];
    $objNotaDebito->fechaComprobante = $fila['fechaComprobante'];
    $objNotaDebito->totalComprobante = $fila['totalComprobante'];
    $objNotaDebito->tieneAdjunto = $fila['tieneAdjunto'];

    array_push($notasDebito, $objNotaDebito);
  }
  $respuesta_estado = $respuesta_estado . " - consulta exitosa";

} catch (PDOException $e) {
  /* El detalle técnico queda solo en el log; al cliente no se le envía */
  escribeLog("salidaJsonNotasDebito.php: " . $e->getMessage());
  $respuesta_estado = "Error en el acceso a la base de datos";
}

/* Objeto que representa el arreglo completo de filas, la cantidad y los datos de estado */
$objNotasDebito = new stdClass();
$objNotasDebito->notasDebito = $notasDebito;
$objNotasDebito->cuenta = count($notasDebito);
$objNotasDebito->estado = $respuesta_estado;

$dbh = null; // Cierro la conexión con la base de datos

/* ---------- 6 y 7) Conversión a JSON y envío al cliente remoto ---------- */
$salidaJson = json_encode($objNotasDebito);
echo $salidaJson;
?>
