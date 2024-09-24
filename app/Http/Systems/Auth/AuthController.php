<?php
namespace App\Http\Systems\Auth;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\Http\Source\Exceptions;
use App\Http\Source\Controller;
use Illuminate\Http\Request;
use App\Http\Source\Wrapper;
use App\Models\Users;

use App\Http\Systems\Auth\Request\CheckRequest;
use App\Http\Systems\Auth\Request\AuthRequest;
use App\Http\Systems\Auth\Request\InRequest;

class AuthController extends Controller{
    use Wrapper;

    function getList($request){}
    function getOne(string $id){}
    function save($request){}
    function change($request){}
    function delete($request){}



    private $live_token_second = 120;//24 * 3600;

    function in(InRequest $request){
        $data = $request->all();
        $user = Users::where('login', $data['login'])->get();

        if($user->isNotEmpty()){
            $user = $user->toArray()[0];
            $data['password'] = md5($data['password']);
            
            if($user['password'] == $data['password']){
                $token =  self::createToken($data['password']);

                return $this->_save($token);
            }
            else throw new Exceptions('Invalid password', 403);
        
        }
        else throw new Exceptions('User not found', 401);
    }

    function check(CheckRequest $request){
        $token = $request->input('token');

        if(!isset($token)) throw new Exceptions('The token is missing', 401);
        
        try {
            $token = Crypt::decryptString($token);
        } catch (DecryptException $e) {
            return throw new Exceptions('Invalid token', 401);
        }
       
       
        $array = json_decode($token, true);
        if(time() - $array['iat'] >= $this->live_token_second) return throw new Exceptions('The token is timeout', 401);
    
        return ['status'=>'Successfully'];
    }

    function out(Request $request){
        return self::_response([
        ])->cookie(
            'token', '', 0
        );
    }

    function auth(AuthRequest $request){
        $data = $request->all();
        $data['password'] = md5($data['password']);

        Users::insert($data);
        $token = self::createToken($data['password']);

        return $this->_save($token);
    }

    private function _save($data){
        return self::_response([
            'token'=> $data,
        ])->cookie(
            'token', $data, $this->live_token_second / 60, '/', '', false, false
        );
    }

    static function createToken($password){
        return Crypt::encryptString(json_encode(['password'=>$password, 'iat'=>time()]));
    }
}
