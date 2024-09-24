<?php
namespace App\Http\Systems\Session\Request;

use App\Http\Source\Request;
use OpenApi\Attributes as OAT;

#[OAT\RequestBody(
    request: 'SessionDeleteRequest',
    required: true,
    content: new OAT\JsonContent(properties: [
        new OAT\Property(property: "id", type: "int", format: "number", example: '1', schema:"required|int"),
        new OAT\Property(property: "method", type: "string", format: "string", example: 'delete', schema:"required|string"),    
    ])
)]
class SessionDeleteRequest extends Request{

    function rules(): array
    {
        return [
            'id'=>'required|int',
        ];
    }
}