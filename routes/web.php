<?php

use App\Http\Controllers\JiriController;
use App\Http\Controllers\ProfileController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', [JiriController::class, 'index'])
        ->name('home');


    Route::get('/jiris/create', [JiriController::class, 'create'])
        ->name('jiris.create');
    Route::post('/jiris', [JiriController::class, 'store'])
        ->name('jiris.store');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';
