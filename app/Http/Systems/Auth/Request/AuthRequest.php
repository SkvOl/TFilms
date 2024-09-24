<?php
namespace App\Http\Systems\Auth\Request;

use App\Http\Source\Request;


class AuthRequest extends Request{

    function rules(): array
    {
        return [
            'login' => 'required|string|min:3|max:15|unique:App\Models\Users,login',
            'password' => 'required|string|min:3|max:255',
        ];
    }
}