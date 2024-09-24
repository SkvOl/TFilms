<?php
namespace App\Http\Systems\Film\Request;

use OpenApi\Attributes as OAT;
use App\Http\Source\Request;


#[OAT\RequestBody(
    request: 'FilmChangeRequest',
    required: true,
    content: new OAT\JsonContent(properties: [
        new OAT\Property(property: "id", type: "int", format: "number", example: '1', schema:"required|int"),
        new OAT\Property(property: "name", type: "string", format: "string", example: 'Форсаж', schema:"string|min:3|max:255|unique:App\Models\Films,name"),
        new OAT\Property(property: "photo", type: "file", format: "image", example: 'sfaf.png', schema:"file|mimes:jpeg,png|max:4096"),   
        new OAT\Property(property: "description", type: "string", format: "string", example: 'Описание фильма форсаж', schema:"string|min:5|max:255"),    
        new OAT\Property(property: "duration", type: "string", format: "time", example: '02:10', schema:"string"),
        new OAT\Property(property: "age_restrictions", type: "int", format: "number", example: "2", schema: 'int|string'),
        new OAT\Property(property: "method", type: "string", format: "string", example: "patch", schema: 'string'),
    ])
)]
class FilmChangeRequest extends Request{

    function rules(): array
    {
        return [
            'id' => 'required|int',
            'name' => 'string|min:3|max:255',
            'photo' => 'file|mimes:jpeg,png|max:4096',
            'description'=>'string|min:5|max:255',
            'duration'=>'string',
            'age_restrictions'=>'int|string',
        ];
    }
}