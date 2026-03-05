<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Livewire\Article;
use App\Livewire\Shows;
use App\Livewire\Tickets;
use App\Livewire\Clients;
use App\Livewire\Bookings;
use App\Livewire\TeatherPlaces;
use App\Livewire\ShowsTypes;
use App\Livewire\TicketsTypes;
use App\Livewire\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Language switcher
Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');

// Authenticated routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    
    // Shows Management
    Route::get('shows', Shows::class)->name('shows');
    Route::get('shows-types', ShowsTypes::class)->name('shows-types');
    
    // Tickets Management
    Route::get('tickets', Tickets::class)->name('tickets');
    Route::get('tickets-types', TicketsTypes::class)->name('tickets-types');
    
    // Clients Management
    Route::get('clients', Clients::class)->name('clients');
    
    // Bookings Management
    Route::get('bookings', Bookings::class)->name('bookings');
    
    // Articles Management
    Route::get('articles', Article::class)->name('articles');
    
    // Theater Places
    Route::get('theater-places', TeatherPlaces::class)->name('theater-places');
    
});
