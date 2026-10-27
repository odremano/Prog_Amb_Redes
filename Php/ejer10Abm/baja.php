<?php
/* Baja de una nota de débito. Recibe por POST el id (clave primaria) del registro a eliminar. */

sleep(3); // Para fines didácticos: simula la demora de la red

include("./datosConexionBase.php"); // $dbname, $host, $user, $password
require("./logErrores.php");

/* Variable que concatena los datos útiles para detectar errores lógicos de resultado */
$respuesta_estado = "Respuesta del servidor a la baja.";

$idNotaDebito = "";
if (isset($_POST['idNotaDebito'])) { $idNotaDebito = $_POST['idNotaDebito']; }

$respuesta_estado = $respuesta_estado . "<br />idNotaDebito recibido para borrar: " . htmlspecialchars($idNotaDebito);

if ($idNotaDebito == "") {
  $respuesta_estado = $respuesta_estado . "<br />BAJA NO REALIZADA: no se recibio el id del registro.";
  echo $respuesta_estado;
  exit;
}

/* ---------- Conexión con el motor ---------- */
try {
  $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
  $dbh = new PDO($dsn, $user, $password); /* Database Handler */
  $respuesta_estado = $respuesta_estado . "<br />Conexion exitosa!";
} catch (PDOException $e) {
  escribeLog("baja.php (conexion): " . $e->getMessage());
  $respuesta_estado = $respuesta_estado . "<br />Error en la conexion (ver errores.log).";
  echo $respuesta_estado;
  exit;
}

/* ---------- Sentencia de baja ---------- */
$sql = "delete from NotaDebito where idNotaDebito=:idNotaDebito;";

try {
  $stmt = $dbh->prepare($sql);
  $respuesta_estado = $respuesta_estado . "<br />Preparacion exitosa!";
} catch (PDOException $e) {
  escribeLog("baja.php (prepare): " . $e->getMessage());
  $respuesta_estado = $respuesta_estado . "<br />Error en la preparacion (ver errores.log).";
  $dbh = null;
  echo $respuesta_estado;
  exit;
}

try {
  $stmt->bindParam(':idNotaDebito', $idNotaDebito);
  $respuesta_estado = $respuesta_estado . "<br />Vinculacion exitosa!";
} catch (PDOException $e) {
  escribeLog("baja.php (bind): " . $e->getMessage());
  $respuesta_estado = $respuesta_estado . "<br />Error en la vinculacion (ver errores.log).";
}

try {
  $stmt->execute();
  $respuesta_estado = $respuesta_estado . "<br />Ejecucion exitosa! Filas eliminadas: " . $stmt->rowCount();
} catch (PDOException $e) {
  escribeLog("baja.php (execute): " . $e->getMessage());
  $respuesta_estado = $respuesta_estado . "<br />Error en la ejecucion (ver errores.log).";
}

$dbh = null; // Cierro la conexión con la base de datos

echo $respuesta_estado;
?>
