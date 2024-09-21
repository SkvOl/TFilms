<?php

namespace App\Http\Systems\Session\Rule;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Films;
use App\Models\FilmsSessions;
use App\Http\Systems\Session\Resource\DistanceSessionsResource;

class DistanceSessionsRule implements Rule{

    private $duration;
    private $sessions;
    private $collision_id;

    function __construct($film_id, $exception = 0){
        $this->duration = strtotime('1970-01-01'.Films::select('duration')->where('id', request()->input($film_id))->get()[0]->duration);
        $this->sessions = DistanceSessionsResource::collection(FilmsSessions::with(['Films'])->where('id', '!=', $exception)->get());// Если сравнивать со всеми сеансами
        // $this->sessions = DistanceSessionsResource::collection(FilmsSessions::with(['Films'])->where('film_id', request()->input($film_id))->where('id', '!=', $exception)->get());// Если сравнивать с сеансами текущего фильма
        $this->sessions = json_decode($this->sessions->toJson(), true);
    }

    function passes($attribute, $value){
        $value = strtotime($value);
        
        foreach($this->sessions as $session){
            if(
                (
                    $session['start'] <= $value + $this->duration AND 
                    $value + $this->duration <= $session['end']
                ) OR 
                (
                    $session['start'] <= $value AND 
                    $value <= $session['end']
                )
            ){
                $this->collision_id = $session['session_id'];
                return false;
            }
        }

        return true;
    }

    function message(){
        return 'The :attribute cannot be in this time interval-'.$this->collision_id;
    }
}