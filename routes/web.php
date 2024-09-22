<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    $films = Http::get('http://79.174.84.7:8085/api/film?order=DESC');
    $sessions = Http::get('http://79.174.84.7:8085/api/film_session?order=DESC');

    // return 'ddd';
    return view('index', ['films'=>$films['data'], 'sessions'=> $sessions['data']]);
});