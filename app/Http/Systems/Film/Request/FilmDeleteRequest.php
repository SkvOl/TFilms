<?php
namespace App\Http\Systems\Film\Request;

use OpenApi\Attributes as OAT;
use App\Http\Source\Request;

#[OAT\RequestBody(
    request: 'FilmDeleteRequest',
    required: true,
    content: new OAT\JsonContent(properties: [
        new OAT\Property(property: "id", type: "int", format: "number", example: '1', schema:"required|int"),
        new OAT\Property(property: "method", type: "string", format: "string", example: 'delete', schema:"required|int"),
    ])
)]
class FilmDeleteRequest extends Request{

    function rules(): array
    {
        return [
            'id' => 'required|int',
        ];
    }
}