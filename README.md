# TheaterTickets

## Mission
TheaterTickets is a live management console for a performing arts venue. It blends Laravel 12, Jetstream 5.4, and Livewire 4 to deliver a realtime CRUD experience for shows, audiences, and ticket inventories while keeping the stack small enough for quick iteration.

## Community-approved Technology Pillars
### Laravel 12 + PHP 8.5
- Backed by PHP 8.5.3 for modern syntax, attributes, and a faster runtime.
- Jetstream 5.4 provides the authentication scaffolding, teams, profile photo support, and rate-limited Fortify routes. Sanctum powers API tokens for any future headless apps.
- Models live under `app/Models`, factories under `database/factories`, and migrations under `database/migrations` so everything follows Laravel's conventions.

### Livewire 4 + Reactive Components
- `App\Livewire` contains the CRUD components for the core domains. Each component uses `WithPagination`, server-side validation, and flash messaging to stay responsive without writing extra JavaScript.
- Dashboard widgets such as `DashboardTotalCard` read from aggregates and keep the admin overview alive.

### Frontend (Tailwind CSS 4 + Flowbite + Vite 7.3.1)
- Styling is handled entirely by Tailwind CSS 4.2.1 with Flowbite 4.0.1 components layered on top.
- Vite 7.3.1 bundles scripts/styles, while `@tailwindcss/postcss` keeps the new Tailwind plugin pipeline compatible with modern PostCSS.
- `resources/css/app.css` now imports Tailwind via `@import "tailwindcss"` to align with the v4 design.

### Node Tooling & Dependencies
- `package.json` pins Vite, Tailwind, Flowbite, `laravel-vite-plugin`, `autoprefixer`, and PostCSS to their latest major releases as of early 2026.
- Installation is handled via `npm install`, and `npm run build` produces the production-ready assets.

## Domain Modules
| Entity | Responsibility |
| --- | --- |
| **Users** | Jetstream-managed authentication, two-factor + profile photos, and Sanctum tokens for API consumers.
| **Shows** | CRUD entries describing performances (name, type, description, image, status). Livewire `Show` component handles creation, updates, and soft-lifecycle controls.
| **Tickets** | Inventory records tied to shows containing codes, seat counts, and pricing data. Validations ensure ticket numbers stay consistent.
| **Clients** | Audience members with demographic data, payment method tracking, and associations to bookings.
| **Baytickets** | Reservations that connect `Clients`, `Shows`, and `Tickets` while housing the generated QR codes.
| **TeatherPlaces** | Theatre venue locations used by the booking flow (note the typo preserved for backward compatibility). Livewire `TeatherPlaces` component manages venues.
| **Articles** | CMS-style content used to highlight news or featured shows; Livewire `Article` manages the CRUD cycle.
| **ShowsType** | Reference data for show categories (drama, musical, etc.). Keep these seeded for consistency on the booking form.
| **TicketsType** | Reference matrix for ticket categories (VIP, standard, etc.) driving pricing and availability logic.

## Setup & Developer Workflow
1. Copy `.env.example` to `.env` and configure database credentials (MySQL for development, SQLite for tests).
2. Run `php8.5 /usr/local/bin/composer install` to restore PHP dependencies.
3. Install Node dependencies: `npm install` (pulls Vite 7.3.1, Tailwind 4.2.1, Flowbite 4.0.1, etc.).
4. Generate the application key: `php8.5 artisan key:generate`.
5. Run migrations: `php8.5 artisan migrate --force`.
6. Build assets: `npm run build`.
7. Run the dev server: `php8.5 artisan serve --host=0.0.0.0 --port=8000`. For HMR, run `npm run dev` in another terminal.

## Testing & Quality Assurance
- Laravel tests execute through PHPUnit 11 via `php8.5 artisan test` (sqlite in-memory configured in `phpunit.xml`).
- Frontend is validated with `npm run build` to ensure Vite/Tailwind flows compile cleanly.
- Flowbite does reference runtime SVG flag assets; the warnings emitted during build can be safely ignored as they resolve from the Flowbite CDN.

## Maintenance & Future Work
- Keep the `palwork.md` file updated with planned CRUD improvements and messaging prep.
- Cache config/views before GitHub deployments: `php8.5 artisan config:cache && php8.5 artisan view:cache`.
- Document architectural changes here when Livewire components gain new dependencies or when the domain model grows.

## Contribution Guidelines
1. Branch from `main` with a descriptive name (e.g., `feature/shows-crud`).
2. Update this README once the domain or stack changes.
3. Run `php8.5 artisan test` and `npm run build` locally before submitting pull requests.
4. Reference `palwork.md` for the current backlog and call out completed tasks in PR summaries.
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
