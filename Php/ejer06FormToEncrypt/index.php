<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Form to encrypt</title>
</head>
<body>

  <h1>Form to encrypt</h1>

  <p>Un único archivo PHP hace las dos cosas: si llega un formulario enviado por POST, calcula la encriptación; en caso contrario, devuelve el formulario. Ejercicio sin estilos a propósito.</p>

<?php
if (isset($_POST['clave'])) {
  /* Llegó el envío del formulario completado */
  $clave = $_POST['clave'];
  $claveMd5 = md5($clave);
  $claveSha1 = sha1($clave);
?>

  <h2>Resultado</h2>
  <p>Clave recibida: <?php echo htmlspecialchars($clave); ?></p>

  <p>Clave encriptada en md5 (128 bits = 16 pares hexadecimales):</p>
  <p><?php echo $claveMd5; ?></p>

  <p>Clave encriptada en sha1 (160 bits = 20 pares hexadecimales):</p>
  <p><?php echo $claveSha1; ?></p>

  <p><a href="./index.php">&larr; Encriptar otra clave</a></p>

<?php
} else {
  /* No llegaron datos en el requerimiento: el servidor devuelve el formulario */
?>

  <form action="./index.php" method="post">
    <p>
      <label for="clave">Ingrese la clave a encriptar:</label><br>
      <input type="text" id="clave" name="clave">
    </p>
    <input type="submit" value="Obtener encriptación">
  </form>

<?php
}
?>

  <p><a href="../index.html">&larr; Volver al índice de PHP</a></p>

</body>
</html>
