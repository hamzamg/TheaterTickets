<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;

use App\Livewire\Article;
use App\Livewire\Show;
use App\Livewire\ShowsType;
use App\Livewire\Tickets;
use App\Livewire\TicketsType;
use App\Livewire\Clients;
use App\Livewire\Baytickets;
use App\Livewire\TeatherPlaces;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Content Management
Route::get('articles', Article::class)->name('articles');

// Shows Management
Route::get('shows', Show::class)->name('shows');
Route::get('shows-types', ShowsType::class)->name('shows-types');

// Tickets Management
Route::get('tickets', Tickets::class)->name('tickets');
Route::get('tickets-types', TicketsType::class)->name('tickets-types');

// Clients Management
Route::get('clients', Clients::class)->name('clients');

// Bookings Management
Route::get('bookings', Baytickets::class)->name('bookings');

// Venues
Route::get('test', TeatherPlaces::class)->name('test');

// Language Switcher
Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Protected Dashboard
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
