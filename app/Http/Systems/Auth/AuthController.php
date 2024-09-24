<?php
namespace App\Http\Systems\Auth;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\Http\Source\Exceptions;
use App\Http\Source\Controller;
use Illuminate\Http\Request;
use App\Http\Source\Wrapper;
use App\Models\Users;
use OpenApi\Attributes as OAT;
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



    private $live_token_second = 3600;

    #[OAT\Post(
        path: '/auth/in',
        summary: 'Аутентификация',
        description: 'Аутентификация пользователя',
        tags: ['auth'],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Успешно',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Successfully'),
                    new OAT\Property(property: 'data', type: 'array', items: new OAT\Items(ref: '#/components/schemas/TokenResponse'))
                ])
            ),
            new OAT\Response(
                response: 401,
                description: 'Пользователь не найден',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Error'),
                    new OAT\Property(property: 'data', properties: [
                        new OAT\Property(property: 'Message', type: 'string', format: 'string', example: 'User not found'),
                        new OAT\Property(property: 'Info', ref: '#/components/schemas/Error'),
                    ])
                ])
            ),
            new OAT\Response(
                response: 403,
                description: 'Не верный пароль',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Error'),
                    new OAT\Property(property: 'data', properties: [
                        new OAT\Property(property: 'Message', type: 'string', format: 'string', example: 'Invalid password'),
                        new OAT\Property(property: 'Info', ref: '#/components/schemas/Error'),
                    ])
                ])
            ),
        ],
        parameters: [new OAT\RequestBody(ref: "#/components/requestBodies/InRequest")]
    )]
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

    #[OAT\Post(
        path: '/auth/check',
        summary: 'Проверка токена',
        description: 'Проверка токена',
        tags: ['auth'],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Успешно',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Successfully'),
                ])
            ),
            new OAT\Response(
                response: 400,
                description: 'Токен неверный или отсутствует',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Error'),
                    new OAT\Property(property: 'data', properties: [
                        new OAT\Property(property: 'Message', type: 'string', format: 'string', example: 'Invalid token'),
                        new OAT\Property(property: 'Info', ref: '#/components/schemas/Error'),
                    ])
                ])
            ),
            new OAT\Response(
                response: 401,
                description: 'Время access токена истекло',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Error'),
                    new OAT\Property(property: 'data', properties: [
                        new OAT\Property(property: 'Message', type: 'string', format: 'string', example: 'The token is timeout'),
                        new OAT\Property(property: 'Info', ref: '#/components/schemas/Error'),
                    ])
                ])
            ),
        ],
        parameters: [new OAT\RequestBody(ref: "#/components/requestBodies/CheckRequest")]
    )]
    function check(CheckRequest $request){
        $token = $request->input('token');

        if(!isset($token)) throw new Exceptions('The token is missing', 400);
        
        try {
            $token = Crypt::decryptString($token);
        } catch (DecryptException $e) {
            return throw new Exceptions('Invalid token', 400);
        }
       
       
        $array = json_decode($token, true);
        if(time() - $array['iat'] >= $this->live_token_second) return throw new Exceptions('The token is timeout', 401);
    
        return ['status'=>'Successfully'];
    }

    #[OAT\Post(
        path: '/auth/out',
        summary: 'Выход из аккаунта',
        description: 'Выход из аккаунта',
        tags: ['auth'],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Успешно',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Successfully'),
                ])
            ),
        ],
    )]
    function out(Request $request){
        return self::_response([
        ])->cookie(
            'token', '', 0
        );
    }


    #[OAT\Post(
        path: '/auth/auth',
        summary: 'Регистрация пользователя',
        description: 'Регистрация пользователя',
        tags: ['auth'],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Успешно',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Successfully'),
                    new OAT\Property(property: 'data', type: 'array', items: new OAT\Items(ref: '#/components/schemas/TokenResponse'))
                ])
            ),
            new OAT\Response(
                response: 400,
                description: 'Не верный запрос',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Error'),
                    new OAT\Property(property: 'data', properties: [
                        new OAT\Property(property: 'Message', type: 'string', format: 'string', example: 'Bad Request'),
                        new OAT\Property(property: 'Info', ref: '#/components/schemas/Error'),
                    ])
                ])
            ),
        ],
        parameters: [new OAT\RequestBody(ref: "#/components/requestBodies/AuthRequest")]
    )]
    function auth(AuthRequest $request){
        $data = $request->all();
        $data['password'] = md5($data['password']);

        Users::insert($data);
        $token = self::createToken($data['password']);

        return $this->_save($token);
    }


    #[OAT\Schema(
        schema: 'TokenResponse',
        properties: [
            new OAT\Property(property: "token", type: "string", format: "string", example: "eyJhbGciOiJzaGEy3rNTYiLCJ0eXAiOiJKV1QifQ==.eyJ1c2VyIjoxLCJwYXNzIjoiY3R2bXof33e5NzUzMSIsImlhdCI6MTcyMDgwNDc1MywiZXh0YSI6MTcyMDg5MTE1MywiZXh0ciI6MTcyMDk3NzU1M30=.ee67049b1dag4898ea60273659487ef0c4e252c610fcfb0fd92bc02138edbf65a1", schema: "required|string"),
        ]
    )]
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
