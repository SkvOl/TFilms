<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FilmsSessions;

class Films extends Model
{
    protected $table = 'films';
    public $timestamps = false;

    function FilmsSessions(){
        return $this->hasMany(FilmsSessions::class, 'film_id', 'id');
    }
}