<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Respuesta POST</title>
</head>
<body>

  <h1>Valores recibidos por POST</h1>

  <p>Método del requerimiento: <?php echo $_SERVER['REQUEST_METHOD']; ?></p>
  <p>URI del requerimiento: <?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?> (los datos no están en la URL: viajan en el body del requerimiento HTTP)</p>

  <p>Nro. de comprobante = <?php echo htmlspecialchars($_POST['nroComprobante']); ?></p>
  <p>Razón social = <?php echo htmlspecialchars($_POST['razonSocial']); ?></p>

  <p><a href="./index.html">&larr; Volver al formulario</a></p>

</body>
</html>
