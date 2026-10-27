<?php
/* Devuelve en JSON el documento binario (pdf) almacenado en el atributo adjunto de una nota de débito.
   El binario se codifica en base64 (solo letras, números, + y /) para poder transferirlo por la red. */

sleep(3); // Para fines didácticos: simula la demora de la red

include("./datosConexionBase.php"); // $dbname, $host, $user, $password
require("./logErrores.php");

$idNotaDebito = "";
if (isset($_POST['idNotaDebito'])) { $idNotaDebito = $_POST['idNotaDebito']; }

$respuesta_estado = "";
$objNotaDebito = new stdClass();
$objNotaDebito->adjunto = "";

try {
  $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
  $dbh = new PDO($dsn, $user, $password); /* Database Handler */
  $respuesta_estado = $respuesta_estado . "conexion exitosa";

  /* Sentencia que levanta el binario de la tabla: preparación, vinculación y ejecución */
  $sql = "select adjunto from NotaDebito where idNotaDebito = :idNotaDebito";
  $stmt = $dbh->prepare($sql);
  $stmt->bindParam(':idNotaDebito', $idNotaDebito);
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $stmt->execute();

  $fila = $stmt->fetch();
  if ($fila == false) {
    $respuesta_estado = $respuesta_estado . " - no existe el registro";
  }
  else if ($fila['adjunto'] === null) {
    $respuesta_estado = $respuesta_estado . " - el registro no tiene documento asociado";
  }
  else {
    $objNotaDebito->adjunto = base64_encode($fila['adjunto']);
    $respuesta_estado = $respuesta_estado . " - consulta exitosa";
  }

} catch (PDOException $e) {
  escribeLog("traeBinario.php: " . $e->getMessage());
  $respuesta_estado = "Error en el acceso a la base de datos";
}

$objNotaDebito->estado = $respuesta_estado;

$dbh = null; // Cierro la conexión con la base de datos

/* JSON_INVALID_UTF8_SUBSTITUTE evita que la codificación a JSON genere caracteres fuera del rango base64 */
$salidaJson = json_encode($objNotaDebito, JSON_INVALID_UTF8_SUBSTITUTE);
echo $salidaJson;
?>
