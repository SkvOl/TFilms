<?php
namespace App\Http\Systems\Session\Request;

use App\Http\Source\Request;
use App\Http\Systems\Session\Rule\DistanceSessionsRule;

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