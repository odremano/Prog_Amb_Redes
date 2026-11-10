-- Usuarios del ejercicio de manejo de sesión (PHP 5).
-- Se importa desde phpMyAdmin o con un cliente sobre la base que ya tiene la tabla Usuario (tablas.sql).
-- La clave se guarda encriptada en sha256 (64 caracteres hexadecimales); el contador de sesiones empieza en 0.
-- Las claves de estos usuarios de demostración se muestran en el formulario de login para la corrección.

SET NAMES utf8mb4;

INSERT INTO Usuario (login, apellido, nombres, password, contadorSesiones) VALUES
  ('jodreman', 'Odreman', 'Jesús',   '4c6a198c315dc8e261eac696d44d4d6b915452c1cf8c6c7c5bcef37e418504dd', 0),
  ('invitado', 'Invitado', 'Usuario', 'ff62ff6012b199e0c060bd2cf436655ddcc6b9782e8b7e509d560c0124efaba3', 0);
