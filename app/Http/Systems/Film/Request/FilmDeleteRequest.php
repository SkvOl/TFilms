<?php
namespace App\Http\Systems\Film\Request;

use App\Http\Source\Request;


class FilmDeleteRequest extends Request{

    function rules(): array
    {
        return [
            'id' => 'required|int',
        ];
    }
}