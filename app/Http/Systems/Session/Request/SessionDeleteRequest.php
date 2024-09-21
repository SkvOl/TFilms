<?php
namespace App\Http\Systems\Session\Request;

use App\Http\Source\Request;

class SessionDeleteRequest extends Request{

    function rules(): array
    {
        return [
            'id'=>'required|int',
        ];
    }
}