<?php
namespace App\Http\Systems\Film;

use App\Http\Systems\Film\Resource\FilmResource;
use App\Http\Source\Controller;
use App\Models\Films;


class FilmController extends Controller{
    
    function getList($request = []){
        return FilmResource::collection(Films::all());
    }

    function getOne(string $id){
        $films = new Films;
        return FilmResource::collection([$films->find($id)]);
    }

    function save($request){
        $id = Films::insertGetId($request->all());
        
        return [
            'id'=>$id,
        ];
    }

    function change($request){
        $id = $request->input('id');
        Films::where('id', $id)->update($request->all());
        
        return [
            'id'=>$id,
        ];
    }

    function delete($request){
        $id = $request->input('id');
        Films::find($id)->delete();
        
        return [
            'id'=>$id,
        ];
    }
}