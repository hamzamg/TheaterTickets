<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;

use App\Livewire\Article;
use App\Livewire\Show;
use App\Livewire\Clients;
use App\Livewire\TeatherPlaces;
use App\Livewire\ShowsType;

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

Route::get('shows-types', ShowsType::class)->name('shows-types');
Route::get('articles', Article::class)->name('articles');
Route::get('shows', Show::class)->name('shows');
Route::get('clients', Clients::class)->name('clients');
Route::get('test', TeatherPlaces::class)->name('test');

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
