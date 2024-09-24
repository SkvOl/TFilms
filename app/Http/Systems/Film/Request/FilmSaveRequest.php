<?php
namespace App\Http\Systems\Film\Request;

use OpenApi\Attributes as OAT;
use App\Http\Source\Request;


#[OAT\RequestBody(
    request: 'FilmSaveRequest',
    required: true,
    content: new OAT\JsonContent(properties: [
        new OAT\Property(property: "name", type: "string", format: "string", example: 'Форсаж', schema:"required|string|min:3|max:255|unique:App\Models\Films,name"),
        new OAT\Property(property: "photo", type: "file", format: "image", example: 'sfaf.png', schema:"required|file|mimes:jpeg,png|max:4096"),   
        new OAT\Property(property: "description", type: "string", format: "string", example: 'Описание фильма форсаж', schema:"required|string|min:5|max:255"),    
        new OAT\Property(property: "duration", type: "string", format: "time", example: '02:10', schema:"required|string"),
        new OAT\Property(property: "age_restrictions", type: "int", format: "number", example: "2", schema: 'required|int|string'),
        new OAT\Property(property: "method", type: "string", format: "string", example: "post", schema: 'required|string'),
    ])
)]
class FilmSaveRequest extends Request{

    function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255|unique:App\Models\Films,name',
            'photo' => 'required|file|mimes:jpeg,png|max:4096',
            'description'=>'required|string|min:5|max:255',
            'duration'=>'required|string',
            'age_restrictions'=>'required|int|string',
        ];
    }
}