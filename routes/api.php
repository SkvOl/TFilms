<?php

use Illuminate\Support\Facades\Route;
use App\Http\Systems\Film\FilmController;
use App\Http\Systems\Session\SessionController;

Route::apiResource('film', FilmController::class);
Route::apiResource('film_session', SessionController::class);