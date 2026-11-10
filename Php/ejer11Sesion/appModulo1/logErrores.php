<?php
/* Escribe una línea en el archivo de texto errores.log de esta carpeta (modalidad de adición),
   con la fecha y hora del servidor, para facilitar la depuración. */
function escribeLog($textoDeError) {
  $puntero = fopen("./errores.log", "a");
  fwrite($puntero, date("Y-m-d H:i") . " ");
  fwrite($puntero, $textoDeError);
  fwrite($puntero, "\n");
  fclose($puntero);
}
?>
