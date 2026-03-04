# TheaterTickets

## Overview
TheaterTickets is an admin dashboard built on Laravel 12 for managing shows, clients, and ticket sales for a theatre. The app uses Laravel Jetstream for authentication, Sanctum for API tokens, Livewire (v4.x) for dynamic UIs, and Tailwind CSS v4 + Flowbite components for styling.

## Core Features
- Manage performances (`Show`, `ShowsType`) with metadata, images, and status flags.
- Track ticket inventory per show (`Ticket`, `Bayticket`) and generate QR codes for purchases.
- Maintain customer records (`Client`) and link them to ticket purchases.
- Multi-section dashboard cards powered by Livewire (ticket counts, shows, clients).
- Role-ready Jetstream scaffolding (profile, teams, two-factor, rate limiting).

## Architecture
- **Backend**: Laravel 12 with Jetstream 5.4, Sanctum, and Fortify service provider modifications. Models live under `app/Models`, factories in `database/factories`, and migrations under `database/migrations`.
- **Livewire**: Namespace `App\Livewire` contains CRUD components for `Show`, `Clients`, `TeatherPlaces`, and dashboard widgets. Each component uses pagination, validation, and Flash messaging.
- **Frontend**: Vite 7.3.1 bundles scripts. Tailwind CSS 4 handles styling with Flowbite 4 widgets. `resources/css/app.css` imports Tailwind v4 via `@import "tailwindcss"`.

## Tech Stack
| Layer | Tool | Version |
| --- | --- | --- |
| PHP runtime | PHP | 8.5.3 |
| Framework | Laravel | 12.53.0 |
| Auth | Jetstream | 5.4.0 |
| Reactive UI | Livewire | 4.2.1 |
| CSS framework | Tailwind CSS | 4.2.1 |
| UI components | Flowbite | 4.0.1 |
| Build tool | Vite | 7.3.1 |
| PostCSS | @tailwindcss/postcss + autoprefixer | latest |
| HTTP client | Axios | ^1.6.7 |
| JS runtime | Node.js 22+ | |

## Setup
1. Copy the `.env.example` file to `.env` and update the database credentials.
2. Install PHP dependencies using `php8.5 /usr/local/bin/composer install`.
3. Install frontend tooling via `npm install` (updates tailwind 4, Flowbite 4, Vite 7.3.1, laravel-vite-plugin 2.1.0, etc.).
4. Generate app key: `php8.5 artisan key:generate`.
5. Run migrations: `php8.5 artisan migrate --force` (sqlite memory is used during testing via phpunit config).
6. Build assets for production: `npm run build`.
7. Start dev server: `php8.5 artisan serve --host=0.0.0.0 --port=8000` and `npm run dev` for Vite HMR.

## Testing & Quality
- PHPUnit 11 is configured via `phpunit.xml`. The Fortify features (registration, password resets, email verification, two-factor) are enabled to mirror Jetstream defaults.
- Run `php8.5 artisan test` after `php8.5 artisan migrate --force` to execute feature suites.
- Frontend build is verified with `npm run build` (Vite + Tailwind v4 + Flowbite).

## Deployment notes
- Cache config/views with `php8.5 artisan config:cache && php8.5 artisan view:cache` before deploying.
- `SESSION_DRIVER=database` is default; ensure migrations are run to create session tables.
- Assets are built with Vite; set `APP_URL` when generating production build.

## Contributing
1. Create a branch from `main` with a descriptive name.
2. Run tests (`composer test`, `npm run build`) before submitting a PR.
3. Document architectural changes in this README and update the diagram assets stored in `Images/` if necessary.
4. Open a pull request against the `main` branch. The repository now enforces PHP 8.5, Laravel 12, Livewire 4, and Tailwind CSS 4, so ensure compatibility with those versions.
