<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    $films = Http::get('http://79.174.84.7:8085/api/film?order=DESC');
    $sessions = Http::get('http://79.174.84.7:8085/api/film_session?order=DESC');
    // $isAuthorized = true;

    // file_put_contents('ddd.txt', var_export(json_decode($films->body(), true) , true));

    // echo "ddd";
    return view('index', [
        'films'=>$films['data'], 
        'sessions'=> $sessions['data'],
        'isAuthorized'=>session('isAuthorized'),
    ]);
})->name('home');