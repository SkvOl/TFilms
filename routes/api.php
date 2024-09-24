<?php

use Illuminate\Support\Facades\Route;
use App\Http\Systems\Film\FilmController;
use App\Http\Systems\Session\SessionController;
use App\Http\Systems\Auth\AuthController;

Route::apiResource('film', FilmController::class);
Route::apiResource('film_session', SessionController::class);

Route::prefix('auth')->group(function () {
    Route::post('in', [AuthController::class, 'in'])->name('in');
    Route::post('out', [AuthController::class, 'out'])->name('out');
    Route::post('auth', [AuthController::class, 'auth'])->name('auth');
    Route::post('check', [AuthController::class, 'check'])->name('check');
});