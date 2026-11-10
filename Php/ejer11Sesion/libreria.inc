<?php
/* Librería de funciones del manejo de sesión. Se incluye con un include() donde se necesite. */

require_once("./logErrores.php");

/* Autenticación de usuario.
   Recibe el login y la clave, encripta la clave en sha256, consulta la tabla de usuarios y
   compara las claves encriptadas. Devuelve true si el usuario es válido, de lo contrario false.
   Si es válido, deja sus datos en $GLOBALS['datosUsuario'] (con el contador de sesiones ya sumado en 1). */
function autenticacion($login, $clave) {

  include("./datosConexionBase.php"); // $dbname, $host, $user, $password

  $aceptado = false;
  $claveEncriptada = hash('sha256', $clave);

  try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $dbh = new PDO($dsn, $user, $password); /* Database Handler */

    /* Consulta a la tabla de usuarios: preparación, vinculación y ejecución */
    $sql = "select idUsuario, login, apellido, nombres, password, contadorSesiones from Usuario where login = :login";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':login', $login);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    $fila = $stmt->fetch();

    /* Comparación de las claves encriptadas */
    if ($fila !== false && $fila['password'] === $claveEncriptada) {

      /* El contador de sesiones se lee de la tabla, se suma 1 y se devuelve sumado a la tabla */
      $contador = $fila['contadorSesiones'] + 1;

      $sql = "update Usuario set contadorSesiones = :contador where idUsuario = :idUsuario";
      $stmt = $dbh->prepare($sql);
      $stmt->bindParam(':contador', $contador);
      $stmt->bindParam(':idUsuario', $fila['idUsuario']);
      $stmt->execute();

      $GLOBALS['datosUsuario'] = [
        "login" => $fila['login'],
        "apellido" => $fila['apellido'],
        "nombres" => $fila['nombres'],
        "contador" => $contador
      ];
      $aceptado = true;
    }

  } catch (PDOException $e) {
    /* El detalle técnico queda solo en el log */
    escribeLog("libreria.inc (autenticacion): " . $e->getMessage());
  }

  $dbh = null; // Cierro la conexión con la base de datos

  return $aceptado;
}

/* Muestra los datos de la sesión del usuario que ingresó */
function infoDeSesion() {
  echo "<table>";
  echo "<tr><td>Identificativo de sesión</td><td>" . htmlspecialchars($_SESSION['identificativoDeSesion']) . "</td></tr>";
  echo "<tr><td>Login de usuario</td><td>" . htmlspecialchars($_SESSION['login']) . "</td></tr>";
  echo "<tr><td>Apellido y nombres</td><td>" . htmlspecialchars($_SESSION['apellido']) . ", " . htmlspecialchars($_SESSION['nombres']) . "</td></tr>";
  echo "<tr><td>Contador de sesiones</td><td>" . htmlspecialchars($_SESSION['ContadorDeSesion']) . "</td></tr>";
  echo "</table>";
}
?>
