# CampusBook · Laboratorio de Ingeniería del Software I

Aplicación web didáctica con PHP 8+, MySQL/MariaDB, HTML, CSS y JavaScript. Arquitectura cliente-servidor; separación básica de vista, lógica y acceso a datos. No pretende ser un framework MVC completo.

## Requisitos
- Laragon o WampServer con Apache, PHP 8.0+ y MySQL/MariaDB.
- Extensión `pdo_mysql` habilitada.
- Git instalado para el laboratorio posterior.

## Instalación local
1. Descomprime la carpeta `campusbook_docente` dentro de `C:\laragon\www\` o `C:\wamp64\www\` (según tu instalación).
2. Inicia Apache y MySQL desde Laragon/WampServer.
3. Abre phpMyAdmin o una consola SQL. Importa **primero** `database/campusbook.sql` y **después** `database/usuario_demo.sql`.
4. Copia `config/database.example.php` a `config/database.php`. Modifica host, puerto, usuario y contraseña si tu entorno lo requiere.
5. Abre `http://localhost/campusbook_docente/public/` en el navegador. Si Laragon configura un virtual host con DocumentRoot en `public/`, puedes usar ese host.
6. Inicia sesión con `estudiante@campusbook.local` y `Campus2026!` (solo demostración local).
7. Busca libros, crea una reserva y cancélala para verificar la integración.

## Importante sobre el servidor web
La entrada pública está en `public/index.php`. Para un despliegue real, configura DocumentRoot hacia `public/` para que `app/`, `config/` y `database/` no sean accesibles desde el navegador. En la configuración de localhost basada en subcarpeta, **úsalo exclusivamente en un equipo local de laboratorio**, sin exponer Apache a Internet.

## Recorrido guiado
- `public/index.php`: punto de entrada y rutas simplificadas.
- `app/bootstrap.php`: conexión PDO, sesión y utilidades.
- `app/Models/Book.php`: consulta del catálogo.
- `app/Services/ReservationService.php`: transacciones y reglas de reserva.
- `app/Views/`: HTML generado desde PHP.
- `public/assets/css/`: estilos; `public/assets/js/`: interacción en navegador.
- `database/`: esquema, datos y cuenta de demostración.

## Git local y publicación
Desde la carpeta raíz del proyecto (no desde `public/`):
```
git init
git status
git add .
git commit -m "chore: agregar base inicial CampusBook"
git switch -c feature/mejora-catalogo
# modifica una vista o el CSS
git add .
git commit -m "feat: mejorar presentacion del catalogo"
git switch main
git merge feature/mejora-catalogo
```
Si la rama inicial se llama `master`, renómbrala primero con `git branch -M main`. Crea un repositorio **vacío** en GitHub, sin README ni .gitignore iniciales, y luego:
```
git remote add origin URL_DEL_REPOSITORIO
git push -u origin main
```
Para practicar Pull Requests, publica una rama antes de integrarla y crea el PR en GitHub. **No hagas el merge local antes del PR** en ese ejercicio.

## Advertencias
- La cuenta de demostración tiene una contraseña pública; no usar en producción.
- Este prototipo no incluye recuperación de contraseña, autorización granular, paginación, auditoría, protección anti-abuso ni despliegue productivo.
- No publiques `config/database.php`, credenciales reales ni copias de bases de datos con datos personales.
- Las reglas del laboratorio son: una reserva activa por libro y usuario; no se permiten reservas sin disponibilidad. No incluye vencimiento de 24 horas ni sanciones, que quedan como posibles extensiones.
