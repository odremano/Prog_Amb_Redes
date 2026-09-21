/* Variables de texto JSON para los ejercicios especiales (Encabezados de notas de débito de ventas).
   La sintaxis tiene que ser perfecta para que JSON.parse() no falle:
   nombres de campo entre comillas dobles, valores numéricos sin comillas y sin coma en el último elemento. */

/* Tabla parametrizable TipoComprobante (codigoTipo, descripcionTipo) */
const textoTiposComprobante = '{"tiposComprobante": [' +
  '{"codigoTipo":"01","descripcionTipo":"Diferencia de Cambio"},' +
  '{"codigoTipo":"02","descripcionTipo":"Ajuste por retardo en el pago"},' +
  '{"codigoTipo":"03","descripcionTipo":"Agregado de producto"},' +
  '{"codigoTipo":"04","descripcionTipo":"Cambio en Alícuota IVA"}' +
  ']}';

/* Encabezados de notas de débito de ventas */
const textoNotasDebito = '{"notasDebito": [' +
  '{"nroComprobante":"ND-0001","nroFacturaImputada":"FA-0101","codigoTipo":"01","codCliente":"CLI001","razonSocial":"Distribuidora Norte S.A.","fechaComprobante":"2026-03-05","totalComprobante":12500},' +
  '{"nroComprobante":"ND-0002","nroFacturaImputada":"FA-0108","codigoTipo":"02","codCliente":"CLI002","razonSocial":"Ferretería El Tornillo S.R.L.","fechaComprobante":"2026-03-12","totalComprobante":3400},' +
  '{"nroComprobante":"ND-0003","nroFacturaImputada":"FA-0115","codigoTipo":"03","codCliente":"CLI003","razonSocial":"Supermercados Del Plata S.A.","fechaComprobante":"2026-03-28","totalComprobante":48000},' +
  '{"nroComprobante":"ND-0004","nroFacturaImputada":"FA-0123","codigoTipo":"04","codCliente":"CLI004","razonSocial":"Almacén Don Pedro","fechaComprobante":"2026-04-02","totalComprobante":1800},' +
  '{"nroComprobante":"ND-0005","nroFacturaImputada":"FA-0130","codigoTipo":"02","codCliente":"CLI005","razonSocial":"Mayorista Cuyo S.A.","fechaComprobante":"2026-04-15","totalComprobante":9750},' +
  '{"nroComprobante":"ND-0006","nroFacturaImputada":"FA-0137","codigoTipo":"01","codCliente":"CLI001","razonSocial":"Distribuidora Norte S.A.","fechaComprobante":"2026-05-06","totalComprobante":7200},' +
  '{"nroComprobante":"ND-0007","nroFacturaImputada":"FA-0142","codigoTipo":"03","codCliente":"CLI006","razonSocial":"Panadería La Espiga","fechaComprobante":"2026-05-21","totalComprobante":2600},' +
  '{"nroComprobante":"ND-0008","nroFacturaImputada":"FA-0150","codigoTipo":"04","codCliente":"CLI003","razonSocial":"Supermercados Del Plata S.A.","fechaComprobante":"2026-06-09","totalComprobante":15300},' +
  '{"nroComprobante":"ND-0009","nroFacturaImputada":"FA-0158","codigoTipo":"02","codCliente":"CLI002","razonSocial":"Ferretería El Tornillo S.R.L.","fechaComprobante":"2026-06-30","totalComprobante":4100},' +
  '{"nroComprobante":"ND-0010","nroFacturaImputada":"FA-0166","codigoTipo":"01","codCliente":"CLI005","razonSocial":"Mayorista Cuyo S.A.","fechaComprobante":"2026-07-14","totalComprobante":21900}' +
  ']}';
