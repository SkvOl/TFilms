<?php

use Illuminate\Support\Facades\Route;
use App\Http\Systems\Film\FilmController;

Route::apiResource('film', FilmController::class);