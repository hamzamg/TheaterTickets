<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
// use App\Http\Livewire\Show;

<<<<<<< HEAD
use App\Livewire\Article;
use App\Livewire\Show;
use App\Livewire\Clients;
use App\Livewire\TeatherPlaces;
=======
use App\Http\Livewire\Article;
use App\Http\Livewire\Show;
use App\Http\Livewire\Clients;
use App\Http\Livewire\TeatherPlaces;
>>>>>>> 1741c742aaeac17f6443898e47bfa9262957cb9d
// use App\Http\Livewire\ClientComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('shows', Show::class)->name('shows');

Route::get('articles', Article::class)->name('articles');
Route::get('shows', Show::class)->name('shows');
Route::get('clients', Clients::class)->name('clients');
Route::get('test', TeatherPlaces::class)->name('test');
// Route::get('clients', ClientComponent::class)->name('clients');


Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
