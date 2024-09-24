<?php
namespace App\Http\Systems\Auth\Request;

use App\Http\Source\Request;


class CheckRequest extends Request{

    function rules(): array
    {
        return [
            'token' => 'required|string',
        ];
    }
}