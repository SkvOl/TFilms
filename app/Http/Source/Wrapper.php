<?php

namespace App\Http\Source;


use Illuminate\Support\Facades\DB;


trait Wrapper{
    static function _response($response, $statusCode = 200){
        $status = (in_array($statusCode, [200, 201, 304]) ? 'Successfully': 'Error');

        return response([
            'status'=> $status.'_'.$statusCode,
            'data'=> $response,

        ])->setStatusCode($statusCode);
    }
}