# Notas Jugadores - Proyecto Laravel, Elaborado por Xavier Basir

Instrucciones rápidas para instalar, migrar y correr este proyecto Laravel en entorno local.

## Requisitos
- PHP 8.1+
- Composer
- MySQL (o MariaDB) y credenciales de base de datos
- Node.js + npm

## Instalación
1. Clona el repositorio y entra al directorio del proyecto:

git clone https://github.com/xbasirdev/notas-jugadores-prueba-tecnica
cd <directorio-del-proyecto>

2. Instala dependencias PHP:

composer install

3. Copia el archivo de entorno y genera la clave de la aplicación:

copy .env.example .env
php artisan key:generate

4. Configura las variables de base de datos en `.env` (DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD).

5. Regenera el autoload (opcional):

composer dump-autoload

## Instalar assets (JS/CSS)

npm install
npm run dev

## Migraciones y seeders
1. Ejecuta las migraciones y seeders:

php artisan migrate --seed
# o para reset limpio:
php artisan migrate:fresh --seed


## Ejecutar la aplicación

php artisan serve --host=127.0.0.1 --port=8000

## Credenciales de ejemplo (creadas por el seeder)
- Admin: admin@example.com / password
- Author: author@example.com / password
- Player: player@example.com / password

## Acceso a la aplicación

- Al hacer PHP artisan serve, la app estará disponible en http://127.0.0.1:8000/
- Puedes iniciar sesión con las credenciales de ejemplo para probar diferentes roles y funcionalidades.
- Los usuarios con rol "admin" pueden gestionar usuarios y notas, "author" puede gestionar notas, y "player" solo puede ver sus notas.

## Notas
- Las vistas Livewire usan la versión instalada en `composer.json`.
- Si ves errores relacionados con Livewire o clases faltantes, limpia cachés y ejecuta `composer dump-autoload`.
- Para desarrollo frontend con Vite, usa `npm run dev`.

## Tests

Ejecutar tests específicos:

php artisan test --filter=PlayerNoteTest

