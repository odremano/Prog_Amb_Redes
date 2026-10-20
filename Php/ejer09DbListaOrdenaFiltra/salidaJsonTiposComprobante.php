<?php
/* Devuelve en JSON la tabla auxiliar TipoComprobante, para poblar el desplegable del filtro. */

sleep(3); // Para fines didácticos: simula la demora de la red

include("./datosConexionBase.php"); // $dbname, $host, $user, $password
require("./logErrores.php");

$respuesta_estado = "";
$tiposComprobante = [];

/* Conexión con el motor */
try {
  $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
  $dbh = new PDO($dsn, $user, $password); /* Database Handler */
  $respuesta_estado = $respuesta_estado . "conexion exitosa";

  /* Sentencia SQL: preparación, fijación del tipo de salida y ejecución */
  $sql = "select id, descripcion from TipoComprobante order by id";
  $stmt = $dbh->prepare($sql);
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $stmt->execute();

  /* Cada fila se convierte en un objeto de datos y se suma al arreglo */
  while ($fila = $stmt->fetch()) {
    $objTipo = new stdClass();
    $objTipo->id = $fila['id'];
    $objTipo->descripcion = $fila['descripcion'];
    array_push($tiposComprobante, $objTipo);
  }
  $respuesta_estado = $respuesta_estado . " - consulta exitosa";

} catch (PDOException $e) {
  /* El detalle técnico queda solo en el log; al cliente no se le envía */
  escribeLog("salidaJsonTiposComprobante.php: " . $e->getMessage());
  $respuesta_estado = "Error en el acceso a la base de datos";
}

/* Objeto que representa el arreglo completo de filas y los datos de estado */
$objTiposComprobante = new stdClass();
$objTiposComprobante->tiposComprobante = $tiposComprobante;
$objTiposComprobante->cuenta = count($tiposComprobante);
$objTiposComprobante->estado = $respuesta_estado;

$dbh = null; // Cierro la conexión con la base de datos

echo json_encode($objTiposComprobante);
?>
