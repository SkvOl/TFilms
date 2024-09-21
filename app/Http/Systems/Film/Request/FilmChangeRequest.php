<?php
namespace App\Http\Systems\Film\Request;

use App\Http\Source\Request;


class FilmChangeRequest extends Request{

    function rules(): array
    {
        return [
            'id' => 'required|int',
            'name' => 'string|min:3|max:255',
            'photo' => 'file|mimes:jpeg,png|max:4096',
            'description'=>'string|min:5|max:255',
            'duration'=>'string',
            'age_restrictions'=>'int',
        ];
    }
}