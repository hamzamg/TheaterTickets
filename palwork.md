# PALWork Plan — TheaterTickets

## Objective
Prepare the TheaterTickets codebase to deliver consistent CRUD experiences for the core domains while keeping the tech stack aligned with the community releases (Laravel 12, PHP 8.5, Livewire 4, Jetstream 5, Tailwind 4, Flowbite 4, Vite 7).

## Strategy
1. Review each entity (Users, Shows, Tickets, Clients, Baytickets, TeatherPlaces, Articles, ShowsType, TicketsType).  
2. Formalize the existing Livewire CRUD components and add missing scaffolding as needed.  
3. Craft data validation, UX flows, and notifications so the next set of feature requests can be handled without reworking the foundations.  
4. Track progress and blockers inside this plan so future work orders can cite precise steps.

## Modules
### 1. Users (Authentication)
- ✅ Jetstream handles registration, login, two-factor, rate limiting, and profile photos.
- Next: audit the Fortify feature list to ensure password resets and email verification are enabled (already done in `config/fortify.php`).  
- Prepare messaging: capture planned SMS/email hooks if needed by future notifications by listing placeholder services.

### 2. Shows
- Livewire `Show` component already provides create/update/delete with pagination.
- Next steps: ensure the `ShowsType` relation (via dropdown) is available, add change-logs, and expose image uploads via Livewire file uploads.

### 3. Tickets
- Model tracks show_id, price, code, counts; migrations exist.  
- Next: add Livewire CRUD component (if missing) for ticket batches, embed the checkbox for `rest_ticket`, and plan the automation for releasing tickets.
- Messages: define the email/sms template for low inventory alerts (store template in `/resources/views/emails`).

### 4. Clients
- `Client` model with demographic fields exists.  
- Next: build Livewire `Clients` component (already referenced in routes). Confirm forms sanitize phone/card fields.  
- Messages: plan for booking confirmation via queued mail using Laravel Mailables.

### 5. Baytickets (Bookings)
- Represents the reservation join table and includes QR codes.
- Next: create Livewire CRUD if not present, ensure QR code generation uses Laravel `QrCode` package, store file path, and include relation to `Clients`/`Shows` in UI.

### 6. TeatherPlaces
- Livewire component is registered as `TeatherPlaces` (typo preserved).  
- Next: ensure translations/performance (maybe rename route once stabilized).  
- Messages: store upcoming events per venue (link to `Show` via pivot table if necessary).

### 7. Articles
- Livewire `Article` component handles news items.  
- Next: add scheduling/status toggles and allow attaching a featured show.

### 8. ShowsType
- Reference data table for show categories.  
- Next: seed common types, build admin form for CRUD (maybe share with `Shows` form via select input).

### 9. TicketsType
- Similar to ShowsType but for ticket categories.  
- Next: Add price modifier metadata, use in ticket creation to prefill `price`.

## Delivery notes
- Keep README synchronized with the tech stack and module status.  
- Use `palwork.md` to record new tasks, blockers, and to signal when a module is ready for production messages.  
- Tag team members (if any) when pushing PRs that touch multiple domains to ensure coordination.
