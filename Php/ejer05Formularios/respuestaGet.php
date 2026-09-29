<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Respuesta GET</title>
</head>
<body>

  <h1>Valores recibidos por GET</h1>

  <p>Método del requerimiento: <?php echo $_SERVER['REQUEST_METHOD']; ?></p>
  <p>URI del requerimiento: <?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?> (los datos viajan en la URL, después del ?)</p>

  <p>Nro. de comprobante = <?php echo htmlspecialchars($_GET['nroComprobante']); ?></p>
  <p>Razón social = <?php echo htmlspecialchars($_GET['razonSocial']); ?></p>

  <p><a href="./index.html">&larr; Volver al formulario</a></p>

</body>
</html>
