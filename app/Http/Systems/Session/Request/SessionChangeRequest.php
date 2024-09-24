<?php
namespace App\Http\Systems\Session\Request;

use App\Http\Source\Request;
use App\Http\Systems\Session\Rule\DistanceSessionsRule;
use OpenApi\Attributes as OAT;

#[OAT\RequestBody(
    request: 'SessionChangeRequest',
    required: true,
    content: new OAT\JsonContent(properties: [
        new OAT\Property(property: "id", type: "int", format: "number", example: '1', schema:"required|int"),
        new OAT\Property(property: "film_id", type: "int", format: "number", example: '1', schema:"int"),
        new OAT\Property(property: "film_start", type: "string", format: "datetime", example: '2024-09-24 23:27', schema:"date|Правило 30 минут"),   
        new OAT\Property(property: "cost", type: "int", format: "number", example: '200', schema:"int|min:150|max:600"),
        new OAT\Property(property: "method", type: "string", format: "string", example: 'patch', schema:"required|string"),    
    ])
)]
class SessionChangeRequest extends Request{

    function rules(): array
    {
        return [
            'id'=>'required|int',
            'film_id'=>'int',
            'film_start'=>['date', new DistanceSessionsRule('film_id', request()->input('id'))],
            'cost'=>'int|min:150|max:2000',
        ];
    }
}