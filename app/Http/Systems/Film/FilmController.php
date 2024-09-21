<?php
namespace App\Http\Systems\Film;

use App\Http\Systems\Film\Resource\FilmResource;
use App\Http\Source\Controller;
use App\Models\Films;
use Illuminate\Support\Str;

class FilmController extends Controller{
    
    function getList($request = []){
        return FilmResource::collection(Films::all());
    }

    function getOne(string $id){
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
        
        if($request->file('photo') !== null){
            $file = $request->file('photo');
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