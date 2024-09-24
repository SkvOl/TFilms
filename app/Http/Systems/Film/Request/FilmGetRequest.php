<?php
namespace App\Http\Systems\Film\Request;

use OpenApi\Attributes as OAT;
use App\Http\Source\Request;

#[OAT\RequestBody(
    request: 'FilmGetRequest',
    required: false,
    content: new OAT\JsonContent(properties: [
        new OAT\Property(property: "order", type: "string", format: "string", example: 'ASC', schema:"string:ASC,DESC"),
    ])
)]
class FilmGetRequest extends Request{

    function rules(): array
    {
        return [
            'order' => 'string:ASC,DESC',
        ];
    }
}