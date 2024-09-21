<?php
namespace App\Http\Systems\Session\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class DistanceSessionsResource extends JsonResource{
    function toArray($request){
        return [
            'session_id'=>$this->id,
            'start'=>strtotime($this->film_start) - strtotime('1970-01-01 00:30:00'),
            'end'=>strtotime($this->film_start) + strtotime('1970-01-01 '.$this->Films[0]->duration) + strtotime('1970-01-01 00:30:00'),
        ];
    }
}