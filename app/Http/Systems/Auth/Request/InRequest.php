<?php
namespace App\Http\Systems\Auth\Request;

use OpenApi\Attributes as OAT;
use App\Http\Source\Request;


#[OAT\RequestBody(
    request: 'InRequest',
    required: true,
    content: new OAT\JsonContent(properties: [
        new OAT\Property(property: "login", type: "string", format: "string", example: 'Test@gmail.com', schema:"required|string|min:3|max:15"),
        new OAT\Property(property: "password", type: "string", format: "password", example: 'Password1234', schema:"required|string|min:3|max:255"),
    ])
)]
class InRequest extends Request{

    function rules(): array
    {
        return [
            'login' => 'required|string|min:3|max:15',
            'password' => 'required|string|min:3|max:255',
        ];
    }
}