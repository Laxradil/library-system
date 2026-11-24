# LibraryHub

LibraryHub is a Laravel-based digital library catalog for browsing books, managing a personal wishlist, and publishing books through role-based contributor and administrator workflows.

## Features

- Public catalog with search, sorting, genre filters, and recently released books
- Contributor book submission and editing
- Administrator approval and user-role management
- Personal wishlists for signed-in users
- Cover image uploads
- Reader view tracking and popularity ranking
- Responsive Breeze authentication and Tailwind interface

## Tech stack

- PHP 8.2+
- Laravel 12
- Laravel Breeze
- Tailwind CSS
- Alpine.js
- Vite
- SQLite by default

## Getting started

### Prerequisites

- PHP 8.2 or newer
- Composer
- Node.js 20+
- npm

### Local setup

```bash
composer install
npm install

cp .env.example .env
php artisan key:generate
touch database/database.sqlite

php artisan migrate --seed
npm run build

php artisan serve
```

For Windows PowerShell, create the SQLite database with:

```powershell
New-Item database/database.sqlite -ItemType File
```

Visit `http://127.0.0.1:8000`.

### Development server

```bash
composer run dev
```

This starts Laravel, the queue listener, Pail, and the Vite development server.

## Demo accounts

The database seeder creates sample users for each role:

| Role | Email | Password |
| --- | --- | --- |
| Administrator | admin@libraryhub.test | password |
| Contributor | contributor@libraryhub.test | password |
| Viewer | viewer@libraryhub.test | password |

These credentials are intended for local development only. Change or remove them before deploying the application.

## Available roles

- **Viewer:** Browse approved books and maintain a wishlist
- **Contributor:** Submit and manage their own books
- **Administrator:** Approve books and manage users and roles

## Testing

```bash
php artisan test
```

Run frontend production compilation with:

```bash
npm run build
```

## Project structure

```text
app/
  Http/Controllers/  Application request handlers
  Models/            Eloquent models
  Policies/          Authorization policies
database/
  migrations/        Database schema
  seeders/           Demo data
resources/
  views/             Blade templates
  css/               Tailwind styles
  js/                Alpine/Vite entrypoints
routes/web.php       Application routes
tests/               Pest tests
```

## Environment

The default `.env.example` uses SQLite. For other databases, update `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`.

Uploaded covers are stored under `storage/app/public/covers`. Make them available with:

```bash
php artisan storage:link
```

## Contributing

Create a focused feature branch, keep changes small, add or update tests, and run `php artisan test` and `npm run build` before submitting a pull request.

## License

This project is open-sourced under the [MIT license](https://opensource.org/licenses/MIT).
