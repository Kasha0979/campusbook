# Guía de laboratorio · CampusBook

## Objetivo
Reconocer un sistema PHP/MySQL, relacionar requisitos con código, ejecutarlo localmente y administrar sus cambios con Git.

## Fase A · Comprensión (20 min)
1. Ubica `public/index.php`, `app/bootstrap.php`, `app/Models/Book.php`, `app/Services/ReservationService.php` y `app/Views/`.
2. Dibuja el flujo navegador → Apache/PHP → MySQL → respuesta HTML.
3. Relaciona RF-01 (consultar catálogo) con la vista y el modelo. Relaciona RF-02 (reservar libro) con el servicio y la base de datos.

## Fase B · Instalación (35 min)
1. Inicia Apache y MySQL.
2. Importa `database/campusbook.sql` y `database/usuario_demo.sql` en ese orden.
3. Copia el archivo de configuración de ejemplo y adapta credenciales.
4. Abre la URL local y comprueba catálogo, búsqueda, inicio de sesión, reserva y cancelación.
5. Registra evidencias de la ejecución local.

## Fase C · Git (40 min)
1. Ejecuta `git init` desde la raíz del proyecto.
2. Comprueba `.gitignore` con `git status`.
3. Realiza un commit inicial.
4. Crea `feature/mejora-catalogo`, modifica un texto o estilo y registra un segundo commit.
5. Regresa a `main` y explica las diferencias entre ramas. En este laboratorio, deja la rama disponible para publicar un Pull Request.

## Fase D · GitHub (30 min)
1. Crea un repositorio remoto vacío.
2. Agrega `origin`, publica `main` y `feature/mejora-catalogo`.
3. Crea un Pull Request, revisa el cambio y fusiónalo desde GitHub.
4. Actualiza la rama local `main` mediante `git pull`.

## Fase E · Transferencia (20 min)
Cada grupo identifica: tecnología de su proyecto, módulos, primer requisito a implementar, estructura de carpetas, archivos excluidos, primera rama y prueba de aceptación.

## Evidencias
URL del repositorio, dos commits, rama publicada, Pull Request fusionado, captura local y matriz requisito→archivo→prueba.

## Matriz de trazabilidad de ejemplo
| Requisito | Código | Prueba |
|---|---|---|
| RF-01 Consultar catálogo | `Book.php` y `Views/books/index.php` | Buscar `Clean Code` y comprobar resultado |
| RF-02 Reservar libro | `ReservationService.php` | Reservar, verificar reducción de disponibilidad |
| RF-03 Cancelar reserva | `ReservationService.php` | Cancelar y verificar restauración de disponibilidad |

## Preguntas de cierre
¿Qué diferencia hay entre Git y GitHub? ¿Qué archivos no deben publicarse? ¿Por qué no equivale un controlador a toda la lógica de negocio? ¿Qué verificarías antes de aprobar un Pull Request?
