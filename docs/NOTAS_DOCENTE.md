# Notas para el docente

- **Arquitectura:** cliente-servidor describe el intercambio HTTP; MVC es un patrón de organización de responsabilidades; las capas son una separación conceptual. Este prototipo tiene separación MVC **simplificada**, no un framework MVC estricto.
- **Alcance:** el catálogo, autenticación, reserva y cancelación funcionan; préstamos y reportes no están implementados.
- **Reglas:** una reserva activa por libro y usuario, disponibilidad mayor que cero, transacciones SQL. No afirmar que hay vigencia de 24 horas o sanciones implementadas.
- **Seguridad:** contraseña de demo solo para local. No desplegar directamente en Internet. En producción, usar DocumentRoot en `public/`, HTTPS, variables de entorno y medidas adicionales.
- **Actividad de mejora:** cambiar el título de la página de catálogo, incorporar una etiqueta visual de categoría o modificar CSS; el primer PR no necesita alterar reglas críticas.
- **Proyecto propio:** los equipos deben reutilizar el método de trabajo, no copiar la temática bibliotecaria ni estar obligados a PHP.
