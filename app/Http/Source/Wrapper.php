<?php

namespace App\Http\Source;


use Illuminate\Support\Facades\DB;


trait Wrapper{
    static function _response($response, $statusCode = 200){
        $status = (in_array($statusCode, [200, 304]) ? 'Successfully': 'Error');

        return response([
            'status'=> $status,
            'data'=> $response,

        ])->setStatusCode($statusCode);
    }
}