<?php
namespace App\Http\Systems\Session\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class SessionResource extends JsonResource{
    function toArray($request){
        return [
            'session_id'=>$this->id,
            'film_id'=>$this->film_id,
            'film_start'=>$this->film_start,
            'cost'=>$this->cost,
        ];
    }
}