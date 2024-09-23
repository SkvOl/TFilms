<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    $films = Http::get('http://79.174.84.7:8085/api/film?order=DESC');
    $sessions = Http::get('http://79.174.84.7:8085/api/film_session?order=DESC');
    $isAuthorized = true;

    
    // return 'ddd';
    return view('index', [
        'films'=>$films['data'], 
        'sessions'=> $sessions['data'],
        'isAuthorized'=>$isAuthorized,
    ]);
})->name('home');

Route::get('/delete_film', function (Request $request) {
    Http::asForm()->post("http://79.174.84.7:8085/api/film", 
        $request->all() + ['method'=>'delete']
    );

    return redirect()->route('home');
});

Route::post('/create_session', function (Request $request) {
    $response = Http::asForm()->post("http://79.174.84.7:8085/api/film_session", 
        $request->all() + ['method'=>'post']
    );
    // file_put_contents('dd.txt', var_export($request->all(), true));
    file_put_contents('dd.txt', var_export(json_decode($response->body(), true), true));

    return redirect()->route('home');
});

Route::post('/delete_session', function (Request $request) {
    Http::asForm()->post("http://79.174.84.7:8085/api/film_session", 
        $request->all() + ['method'=>'delete']
    );

    return redirect()->route('home');
});