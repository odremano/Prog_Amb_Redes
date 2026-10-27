<?php
/* Alta de una nota de débito. Recibe por POST (FormData) los datos del formulario de alta.
   Primero se da de alta el registro con sus atributos simples y, en una segunda etapa,
   se actualiza el atributo binario (el documento pdf) con el file recibido. */

sleep(3); // Para fines didácticos: simula la demora de la red

include("./datosConexionBase.php"); // $dbname, $host, $user, $password
require("./logErrores.php");

/* Variable que concatena los datos útiles para detectar errores lógicos de resultado */
$respuesta_estado = "Respuesta del servidor al alta. Entradas recibidas en el req http:";

/* ---------- Recepción de las variables del requerimiento ---------- */
$nroComprobante = "";
$nroFacturaImputada = "";
$tipoComprobante = "";
$codCliente = "";
$razonSocial = "";
$fechaComprobante = "";
$totalComprobante = "";

if (isset($_POST['nroComprobante'])) { $nroComprobante = $_POST['nroComprobante']; }
if (isset($_POST['nroFacturaImputada'])) { $nroFacturaImputada = $_POST['nroFacturaImputada']; }
if (isset($_POST['tipoComprobante'])) { $tipoComprobante = $_POST['tipoComprobante']; }
if (isset($_POST['codCliente'])) { $codCliente = $_POST['codCliente']; }
if (isset($_POST['razonSocial'])) { $razonSocial = $_POST['razonSocial']; }
if (isset($_POST['fechaComprobante'])) { $fechaComprobante = $_POST['fechaComprobante']; }
if (isset($_POST['totalComprobante'])) { $totalComprobante = $_POST['totalComprobante']; }

$respuesta_estado = $respuesta_estado . "<br />nroComprobante: " . htmlspecialchars($nroComprobante);
$respuesta_estado = $respuesta_estado . "<br />nroFacturaImputada: " . htmlspecialchars($nroFacturaImputada);
$respuesta_estado = $respuesta_estado . "<br />tipoComprobante: " . htmlspecialchars($tipoComprobante);
$respuesta_estado = $respuesta_estado . "<br />codCliente: " . htmlspecialchars($codCliente);
$respuesta_estado = $respuesta_estado . "<br />razonSocial: " . htmlspecialchars($razonSocial);
$respuesta_estado = $respuesta_estado . "<br />fechaComprobante: " . htmlspecialchars($fechaComprobante);
$respuesta_estado = $respuesta_estado . "<br />totalComprobante: " . htmlspecialchars($totalComprobante);

/* Todos los datos simples son obligatorios */
if ($nroComprobante == "" || $nroFacturaImputada == "" || $tipoComprobante == "" || $codCliente == "" || $razonSocial == "" || $fechaComprobante == "" || $totalComprobante == "") {
  $respuesta_estado = $respuesta_estado . "<br />ALTA NO REALIZADA: faltan datos obligatorios.";
  echo $respuesta_estado;
  exit;
}

$altaRealizada = false;
$idNotaDebito = "";

/* ---------- Conexión con el motor ---------- */
try {
  $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
  $dbh = new PDO($dsn, $user, $password); /* Database Handler */
  $respuesta_estado = $respuesta_estado . "<br />Conexion exitosa!";
} catch (PDOException $e) {
  escribeLog("alta.php (conexion): " . $e->getMessage());
  $respuesta_estado = $respuesta_estado . "<br />Error en la conexion (ver errores.log).";
  echo $respuesta_estado;
  exit;
}

/* ---------- Primera etapa: alta simple (sin el atributo binario) ---------- */
$sql = "insert into NotaDebito (nroComprobante,nroFacturaImputada,tipoComprobante,codCliente,razonSocial,fechaComprobante,totalComprobante) ";
$sql = $sql . "values (:nroComprobante,:nroFacturaImputada,:tipoComprobante,:codCliente,:razonSocial,:fechaComprobante,:totalComprobante);";

try {
  $stmt = $dbh->prepare($sql);
  $respuesta_estado = $respuesta_estado . "<br />Preparacion exitosa!";
} catch (PDOException $e) {
  escribeLog("alta.php (prepare): " . $e->getMessage());
  $respuesta_estado = $respuesta_estado . "<br />Error en la preparacion (ver errores.log).";
  $dbh = null;
  echo $respuesta_estado;
  exit;
}

try {
  $stmt->bindParam(':nroComprobante', $nroComprobante);
  $stmt->bindParam(':nroFacturaImputada', $nroFacturaImputada);
  $stmt->bindParam(':tipoComprobante', $tipoComprobante);
  $stmt->bindParam(':codCliente', $codCliente);
  $stmt->bindParam(':razonSocial', $razonSocial);
  $stmt->bindParam(':fechaComprobante', $fechaComprobante);
  $stmt->bindParam(':totalComprobante', $totalComprobante);
  $respuesta_estado = $respuesta_estado . "<br />Vinculacion exitosa!";
} catch (PDOException $e) {
  escribeLog("alta.php (bind): " . $e->getMessage());
  $respuesta_estado = $respuesta_estado . "<br />Error en la vinculacion (ver errores.log).";
}

try {
  $stmt->execute();
  $respuesta_estado = $respuesta_estado . "<br />Ejecucion exitosa!";
  $altaRealizada = true;
} catch (PDOException $e) {
  escribeLog("alta.php (execute): " . $e->getMessage());
  $respuesta_estado = $respuesta_estado . "<br />Error en la ejecucion (ver errores.log).";
}

/* ---------- Segunda etapa: atributo binario, ya con el registro dado de alta ---------- */
if ($altaRealizada) {
  /* Clave primaria autonumérica del registro recién insertado */
  $idNotaDebito = $dbh->lastInsertId();

  $respuesta_estado = $respuesta_estado . "<br /><br />Parte registro documento pdf:";

  if (!isset($_FILES['adjunto'])) {
    $respuesta_estado = $respuesta_estado . "<br />No se inicializo global \$_FILES";
  }
  else {
    if (empty($_FILES['adjunto']['name'])) {
      $respuesta_estado = $respuesta_estado . "<br />No ha sido seleccionado ningun file para enviar!";
    }
    else if ($_FILES['adjunto']['error'] != 0) {
      $respuesta_estado = $respuesta_estado . "<br />El file no pudo recibirse (codigo de error de la subida: " . $_FILES['adjunto']['error'] . "). Puede superar el tamano maximo permitido.";
    }
    else {
      $respuesta_estado = $respuesta_estado . "<br />Trae adjunto asociado a idNotaDebito: " . $idNotaDebito;
      $respuesta_estado = $respuesta_estado . "<br />name: " . htmlspecialchars($_FILES['adjunto']['name']);
      $respuesta_estado = $respuesta_estado . "<br />size: " . $_FILES['adjunto']['size'];

      /* El contenido del file queda en un archivo temporario del servidor */
      $contenidoPdf = file_get_contents($_FILES['adjunto']['tmp_name']);

      $sql = "update NotaDebito set adjunto=:contenidoPdf where idNotaDebito=:idNotaDebito;";

      try {
        $stmt = $dbh->prepare($sql);
        $respuesta_estado = $respuesta_estado . "<br />Preparacion exitosa!";
      } catch (PDOException $e) {
        escribeLog("alta.php (prepare binario): " . $e->getMessage());
        $respuesta_estado = $respuesta_estado . "<br />Error en la preparacion (ver errores.log).";
        $dbh = null;
        echo $respuesta_estado;
        exit;
      }

      try {
        $stmt->bindParam(':contenidoPdf', $contenidoPdf, PDO::PARAM_LOB);
        $stmt->bindParam(':idNotaDebito', $idNotaDebito);
        $respuesta_estado = $respuesta_estado . "<br />Vinculacion exitosa!";
      } catch (PDOException $e) {
        escribeLog("alta.php (bind binario): " . $e->getMessage());
        $respuesta_estado = $respuesta_estado . "<br />Error en la vinculacion (ver errores.log).";
      }

      try {
        $stmt->execute();
        $respuesta_estado = $respuesta_estado . "<br />Ejecucion exitosa! El pdf asociado ha sido registrado.";
      } catch (PDOException $e) {
        escribeLog("alta.php (execute binario): " . $e->getMessage());
        $respuesta_estado = $respuesta_estado . "<br />Error en la ejecucion (ver errores.log).";
      }
    }
  }
}

$dbh = null; // Cierro la conexión con la base de datos

echo $respuesta_estado;
?>
