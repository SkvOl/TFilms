<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Closure;

class AuthMiddleware {
    public function handle(Request $request, Closure $next) {
        $token = $request->cookie('token');

        if(!isset($token)) {
            session(['isAuthorized'=> false]);
            return $next($request);
        }

        $response = Http::post('http://79.174.84.7:8085/api/auth/check', [
            'token'=>$token
        ])->body();

        
        if(json_decode($response, true)['status'] != 'Successfully'){
            session(['isAuthorized'=> false]);
            return $next($request);
        }
        
        session(['isAuthorized'=> true]);
        return $next($request);
    }
}