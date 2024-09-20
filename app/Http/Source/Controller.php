<?php

namespace App\Http\Source;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Source\Wrapper;

abstract class Controller{
    use Wrapper;

    private $validation;
    private $system;

    public $url;

    abstract function getList($request);
    abstract function getOne(string $id);
    abstract function post($request);

    function __construct(){
        $classArray = get_declared_classes();
        $this->validation = $classArray[array_search('App\\Http\\Source\\Controller', $classArray) - 1];
        
        $targetController = explode('\\', $this->validation);
        $targetController = end($targetController);
        $this->system = str_replace('Controller', '', $targetController);
        
        $this->validation = $this->exist(str_replace($targetController, 'Request\\'.$this->system.'Request', $this->validation));
    }


    function index(Request $request){ 
        $statusCode = 200;
        $response = Cache::rememberForever($this->system, function () use (&$statusCode, $request) {
            $statusCode = 200;
            return $this->getList($request);
        });
        // $response = $this->getList($request); 
        return self::_response($response, $statusCode);
    }
    
    function show(string $id){
        $response = $this->getOne($id);
        
        if(!isset($response[0])) $response = $response[0];
        return self::_response($response, 200);
    }

    function store(Request $request){
        if($this->validation !== false) app($this->validation);
        
        $response = '';
        DB::transaction(function() use ($request, &$response) {
            $response = $this->post($request);

            if(Cache::has($this->system)) Cache::forget($this->system);
        });

        return self::_response($response, 200);
    }

    private function exist($className){
        try{
            new $className;
            return $className;
        }
        catch(\Throwable $th){
            return false;
        }
    }
}
