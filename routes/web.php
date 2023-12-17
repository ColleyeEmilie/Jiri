<?php

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\JiriController;
use App\Http\Controllers\JuryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjetsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/jiris', [JiriController::class, 'index'])
    ->name('jiris.index');

Route::middleware('jury')->group(function (){
    Route::resource('jury', JuryController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [JiriController::class, 'index'])
        ->name('home');

    Route::resource('contacts', ContactsController::class);
    Route::resource('projets', ProjetsController::class);
    Route::resource('jiris', JiriController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';
