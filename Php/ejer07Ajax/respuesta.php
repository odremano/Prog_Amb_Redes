<?php
/* Para fines didácticos: tiempo muerto que simula una respuesta compleja a través de la red. */
sleep(3);

/* Elabora y envía la respuesta sin importar si el requerimiento es o no AJAX. */
$clave = $_POST['clave'];

echo "<p>Método del requerimiento: " . $_SERVER['REQUEST_METHOD'] . "</p>";
echo "<p>Clave recibida: " . htmlspecialchars($clave) . "</p>";
echo "<p>Clave encriptada en md5 (128 bits = 16 pares hexadecimales):<br>" . md5($clave) . "</p>";
echo "<p>Clave encriptada en sha1 (160 bits = 20 pares hexadecimales):<br>" . sha1($clave) . "</p>";
?>
