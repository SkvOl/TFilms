<?php
namespace App\Http\Systems\Film\Resource;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'FilmResource',
    properties: [
        new OAT\Property(property: 'film_id', type: 'int', format: 'number', example: '1'),
        new OAT\Property(property: "name", type: "string", format: "string", example: "Форсаж"),
        new OAT\Property(property: "photo", type: "string", format: "string", example: "dgdsfg.png"),
        new OAT\Property(property: "description", type: "string", format: "string", example: "Описание фильма форсаж"),
        new OAT\Property(property: "duration", type: "string", format: "time", example: "02:12"),
        new OAT\Property(property: "age_restrictions", type: "int", format: "number", example: "1"),
    ]
)]
class FilmResource extends JsonResource{
    function toArray($request){
        return [
            'film_id'=>$this->id,
            'name'=>$this->name,
            'photo'=>$this->photo,
            'description'=>$this->description,
            'duration'=>$this->duration,
            'age_restrictions'=>$this->age_restrictions,
        ];
    }
}