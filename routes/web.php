<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    
    // Theater Management Routes
    Route::view('shows', 'pages.shows.index')->name('shows');
    Route::view('tickets', 'pages.tickets.index')->name('tickets');
    Route::view('clients', 'pages.clients.index')->name('clients');
    Route::view('bookings', 'pages.bookings.index')->name('bookings');
});

require __DIR__.'/settings.php';
