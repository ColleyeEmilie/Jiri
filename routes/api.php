<?php

use App\Models\Jiri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('jiris', function () {
    return User::whereEmail('dominique.vilain@hepl.be')
        ->firstOrFail();
});

Route::get('jiris/{jiri}', function (Jiri $jiri) {
    return $jiri->load('students', 'students.implementations.project', 'evaluators');
});
