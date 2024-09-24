<?php
namespace App\Http\Systems\Session\Request;

use App\Http\Source\Request;
use App\Http\Systems\Session\Rule\DistanceSessionsRule;
use OpenApi\Attributes as OAT;

#[OAT\RequestBody(
    request: 'SessionSaveRequest',
    required: true,
    content: new OAT\JsonContent(properties: [
        new OAT\Property(property: "film_id", type: "ште", format: "number", example: '1', schema:"required|int"),
        new OAT\Property(property: "film_start", type: "string", format: "datetime", example: '2024-09-24 23:27', schema:"required|date|Правило 30 минут"),   
        new OAT\Property(property: "cost", type: "int", format: "number", example: '200', schema:"required|int|min:150|max:600"),    
        new OAT\Property(property: "method", type: "string", format: "string", example: 'post', schema:"required|string"),
    ])
)]
class SessionSaveRequest extends Request{

    function rules(): array
    {
        return [
            'film_id'=>'required|int',
            'film_start'=>['required', 'date', new DistanceSessionsRule('film_id')],
            'cost'=>'required|int|min:150|max:600',
        ];
    }
}