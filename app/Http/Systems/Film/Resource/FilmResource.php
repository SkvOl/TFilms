<?php
namespace App\Http\Systems\Film\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource{
    function toArray($request){
        return [
            'film_id'=>$this->id,
            'name'=>$this->name,
            'photo'=>$this->photo,
            'description'=>$this->description,
            'duration'=>$this->duration,
            'age_restrictions'=>$this->age_restrictions,
        ];
    }
}