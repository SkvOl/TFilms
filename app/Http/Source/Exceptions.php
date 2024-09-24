<?php

namespace App\Http\Source;


use OpenApi\Attributes as OAT;
use App\Http\Source\Wrapper;
use Exception;

class Exceptions extends Exception{
    use Wrapper;

    private $status;

    function __construct($message, $status = 500) {
        $this->message = $message;
        $this->status = $status;
    }


    #[OAT\Schema(
        schema: 'Error',
        properties: [
            new OAT\Property(property: 'line', type: 'int', example: 37),
            new OAT\Property(property: 'file', type: 'string', format: 'string', example: '/path_to_file/...'),
        ]
    )]
    function render($request){
        return self::_response([
            'Message'=>$this->getMessage(),
            'Info'=>[
                // 'trace'=>$throwable->getTrace(),
                'line'=>$this->getLine(),
                'file'=>$this->getFile(),
            ]
        ], $this->status);
    }
}