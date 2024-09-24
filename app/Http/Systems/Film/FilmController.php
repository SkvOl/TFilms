<?php
namespace App\Http\Systems\Film;

use App\Http\Systems\Film\Resource\FilmResource;
use App\Http\Source\Controller;
use App\Models\Films;
use Illuminate\Support\Str;


class FilmController extends Controller{
    
    function getList($request){
        if($request->input('order') !== null) return FilmResource::collection(Films::select()->orderBy('id', $request->input('order'))->get());
        else return FilmResource::collection(Films::all());
    }

    function getOne(string $id){
        file_put_contents('para_getOne.txt', var_export($id, true));

        $films = new Films;
        return FilmResource::collection([$films->find($id)]);
    }

    function save($request){
        $file = $request->file('photo');
        $file_name = Str::random(10).'.'.$file->getClientOriginalExtension();
        $file->storeAs('files', $file_name);

        $id = Films::insertGetId(['photo'=>$file_name] + $request->all());
        
        return [
            'id'=>$id,
        ];
    }

    function change($request){
        $id = $request->input('id');
        $file = $request->file('photo');

        if($file !== null){
            $file_name = Str::random(10).'.'.$file->getClientOriginalExtension();
            $file->storeAs('files', $file_name);
            
            Films::where('id', $id)->update(['photo'=>$file_name] + $request->all());
        }
        else Films::where('id', $id)->update($request->all());
        
        
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