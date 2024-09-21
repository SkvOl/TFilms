<?php
namespace App\Http\Systems\Film\Request;

use App\Http\Source\Request;

class FilmSaveRequest extends Request{

    function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255|unique:App\Models\Films,name',
            'photo' => 'required|string|min:1|max:255',
            'description'=>'required|string|min:5|max:255',
            'duration'=>'required|string',
            'age_restrictions'=>'required|int',
        ];
    }
}