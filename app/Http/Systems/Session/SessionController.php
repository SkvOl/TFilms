<?php
namespace App\Http\Systems\Session;

use App\Http\Systems\Session\Resource\SessionResource;
use App\Http\Source\Controller;
use App\Models\FilmsSessions;


class SessionController extends Controller{
    
    function getList($request = []){
        return SessionResource::collection(FilmsSessions::all());
    }

    function getOne(string $id){
        $filmsSessions = new FilmsSessions;
        return SessionResource::collection([$filmsSessions->find($id)]);
    }

    function save($request){
        $id = FilmsSessions::insertGetId($request->all());
        
        return [
            'id'=>$id,
        ];
    }

    function change($request){
        $id = $request->input('id');
        FilmsSessions::where('id', $id)->update($request->all());
        
        return [
            'id'=>$id,
        ];
    }

    function delete($request){
        $id = $request->input('id');
        FilmsSessions::find($id)->delete();
        
        return [
            'id'=>$id,
        ];
    }
}