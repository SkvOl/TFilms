<?php
namespace App\Http\Systems\Session\Resource;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'SessionResource',
    properties: [
        new OAT\Property(property: 'session_id', type: 'int', format: 'number', example: '1'),
        new OAT\Property(property: 'film_id', type: 'int', format: 'number', example: '1'),
        new OAT\Property(property: 'film_start', type: 'string', format: 'datetime', example: '2024-09-24 23:15'),
        new OAT\Property(property: 'cost', type: 'int', format: 'number', example: '350'),
    ]
)]
class SessionResource extends JsonResource{
    function toArray($request){
        return [
            'session_id'=>$this->id,
            'film_id'=>$this->film_id,
            'film_start'=>$this->film_start,
            'cost'=>$this->cost,
        ];
    }
}