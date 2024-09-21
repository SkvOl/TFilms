<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Films;

class FilmsSessions extends Model
{
    protected $table = 'films_sessions';
    public $timestamps = false;

    function Films(){
        return $this->hasMany(Films::class, 'id', 'film_id');
    }
}

