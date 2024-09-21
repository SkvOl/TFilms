<?php
namespace App\Http\Systems\Session\Request;

use App\Http\Source\Request;
use App\Http\Systems\Session\Rule\DistanceSessionsRule;

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