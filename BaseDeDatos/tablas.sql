-- Tablas de la base de datos (MySQL) para los ejercicios de PHP 3.
-- Se importa desde phpMyAdmin (pestaña Importar) sobre la base ya creada en el proveedor.
-- Tabla asignada: 10) Encabezados de notas de débito de ventas.

SET NAMES utf8mb4;

-- 2) Tabla auxiliar que puebla el campo parametrizable de la tabla principal
CREATE TABLE TipoComprobante (
  id VARCHAR(2) NOT NULL,
  descripcion VARCHAR(60) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 1) Tabla principal
CREATE TABLE NotaDebito (
  idNotaDebito INT NOT NULL AUTO_INCREMENT,           -- a) clave primaria autonumérica
  nroComprobante VARCHAR(20) NOT NULL,                -- b) identificador de registro
  nroFacturaImputada VARCHAR(20) NOT NULL,
  tipoComprobante VARCHAR(2) NOT NULL,                -- d) parametrizable: clave foránea a TipoComprobante
  codCliente VARCHAR(10) NOT NULL,
  razonSocial VARCHAR(80) NOT NULL,                   -- c) campo descriptivo
  fechaComprobante DATE NOT NULL,                     -- f) fecha
  totalComprobante DOUBLE NOT NULL,                   -- e) numérico real para operar
  adjunto LONGBLOB NULL,                              -- g) binario para guardar pdfs o imágenes
  PRIMARY KEY (idNotaDebito),
  CONSTRAINT fk_notadebito_tipo FOREIGN KEY (tipoComprobante) REFERENCES TipoComprobante (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3) Tabla de usuarios
CREATE TABLE Usuario (
  idUsuario INT NOT NULL AUTO_INCREMENT,
  login VARCHAR(30) NOT NULL,
  apellido VARCHAR(40) NOT NULL,
  nombres VARCHAR(60) NOT NULL,
  password VARCHAR(64) NOT NULL,                      -- encriptada en sha (sha1 = 40 caracteres, sha256 = 64)
  contadorSesiones INT(5) NOT NULL DEFAULT 0,
  PRIMARY KEY (idUsuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Datos: los mismos de los ejercicios especiales (datosNotasDebito.js)
INSERT INTO TipoComprobante (id, descripcion) VALUES
  ('01', 'Diferencia de Cambio'),
  ('02', 'Ajuste por retardo en el pago'),
  ('03', 'Agregado de producto'),
  ('04', 'Cambio en Alícuota IVA');

INSERT INTO NotaDebito (nroComprobante, nroFacturaImputada, tipoComprobante, codCliente, razonSocial, fechaComprobante, totalComprobante) VALUES
  ('ND-0001', 'FA-0101', '01', 'CLI001', 'Distribuidora Norte S.A.',    '2026-03-05', 12500),
  ('ND-0002', 'FA-0108', '02', 'CLI002', 'Ferretería El Tornillo S.R.L.', '2026-03-12', 3400),
  ('ND-0003', 'FA-0115', '03', 'CLI003', 'Supermercados Del Plata S.A.', '2026-03-28', 48000),
  ('ND-0004', 'FA-0123', '04', 'CLI004', 'Almacén Don Pedro',           '2026-04-02', 1800),
  ('ND-0005', 'FA-0130', '02', 'CLI005', 'Mayorista Cuyo S.A.',         '2026-04-15', 9750),
  ('ND-0006', 'FA-0137', '01', 'CLI001', 'Distribuidora Norte S.A.',    '2026-05-06', 7200),
  ('ND-0007', 'FA-0142', '03', 'CLI006', 'Panadería La Espiga',         '2026-05-21', 2600),
  ('ND-0008', 'FA-0150', '04', 'CLI003', 'Supermercados Del Plata S.A.', '2026-06-09', 15300),
  ('ND-0009', 'FA-0158', '02', 'CLI002', 'Ferretería El Tornillo S.R.L.', '2026-06-30', 4100),
  ('ND-0010', 'FA-0166', '01', 'CLI005', 'Mayorista Cuyo S.A.',         '2026-07-14', 21900);
