<?php

namespace App\Http\Source;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Source\Wrapper;


 /**
 * @OA\Info(
 *     version="1.0",
 *     title="API TFilms"
 * )
 */
abstract class Controller{
    use Wrapper;

    private $validation;
    private $system;
    private $targetController;

    public $url;

    abstract function getList($request);
    abstract function getOne(string $id);
    abstract function save($request);
    abstract function change($request);
    abstract function delete($request);

    function __construct(){
        $this->validation = get_class($this);
        
        $this->targetController = explode('\\', $this->validation);
        $this->targetController = end($this->targetController);
        $this->system = str_replace('Controller', '', $this->targetController);
    }



    function index(Request $request){ 
        $statusCode = 201; 

        $response = Cache::rememberForever($this->system. md5(json_encode($request->all(), JSON_UNESCAPED_UNICODE)), function () use (&$statusCode, $request) {
            $statusCode = 200;
            return $this->getList($request);
        });
    
        return self::_response($response, $statusCode);
    }
    
    function show(string $id){
        $response = $this->getOne($id);
        
        if(!isset($response[0])) $response = $response[0];
        return self::_response($response, 200);
    }

    function store(Request $request){
        $method = self::choice($request);
        $this->validation = $this->exist(str_replace($this->targetController, 'Request\\'.$this->system.$method['request'].'Request', $this->validation));
        $request->request->remove('method');

        if($this->validation !== false) app($this->validation);
        
        $response = '';
        DB::transaction(function() use ($request, $method, &$response) {
            $method = $method['method'];
            $response = $this->$method($request);


            $this->cacheDelete($this->system.'%');
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

    
    private static function choice(Request $request):mixed {
        switch($request->input('method')){
            case 'post': return ['method'=>'save', 'request'=>'Save'];
            case 'patch': return ['method'=>'change', 'request'=>'Change'];
            case 'delete': return ['method'=>'delete', 'request'=>'Delete'];
            default: return ['method'=>'save', 'request'=>'Save'];
        }
    }

    private function cacheDelete($key){
        $response = DB::table('cache')->where('key', 'like', $key);
        // file_put_contents('delete.txt', str_replace('?', '"'.$this->system.'%"', $response->toSql()));
        $response->delete();
    }
}
