# PALWork Plan — TheaterTickets

## Objective
Build a complete theater ticket management system with Laravel 12, Livewire 3.5, PHP 8.5, and modern UI using shadcn-inspired design.

## Technology Stack
- **Laravel**: 12.x
- **PHP**: 8.5
- **Livewire**: 3.5
- **Database**: SQLite (dev) / MySQL (prod)
- **Frontend**: Tailwind CSS + shadcn-inspired components
- **Build Tool**: Vite

## Modules

### 1. Authentication
- Laravel Breeze for simple auth
- Admin user: hamzaAd / ad123456

### 2. Shows Management
- CRUD operations
- Fields: name, type, description, photo, active
- Relations: ShowsType, Tickets

### 3. Tickets Management
- CRUD operations
- Fields: date, time, quantity, price, code, type
- Relations: Show, TicketsType

### 4. Clients Management
- CRUD operations
- Fields: firstname, lastname, sex, age, phone, payment method

### 5. Bookings (Baytickets)
- QR code generation
- Relations: Client, Show, Ticket

### 6. Theater Places (Seating)
- Grid layout management
- Reservation tracking

### 7. Articles (News)
- News/announcements management

### 8. Reference Data
- ShowsType: Categories for shows
- TicketsType: Categories for tickets with price modifiers

## Delivery Process
- Commit after each module
- Create PR for each milestone
- Test routes before/after deployment
- Update message.md continuously
