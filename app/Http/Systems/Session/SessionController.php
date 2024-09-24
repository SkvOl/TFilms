<?php
namespace App\Http\Systems\Session;

use App\Http\Systems\Session\Resource\SessionResource;
use OpenApi\Attributes as OAT;
use App\Http\Source\Controller;
use App\Models\FilmsSessions;


class SessionController extends Controller{
    
    #[OAT\Get(
        path: '/film_session',
        summary: 'Получение списка сеансов фильма',
        description: 'Получение списка сеансов фильма',
        tags: ['film_session'],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Успешно',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Successfully'),
                    new OAT\Property(property: 'data', type: 'array', items: new OAT\Items(ref: '#/components/schemas/SessionResource'))
                ])
            ),
            new OAT\Response(
                response: 500,
                description: 'Ошибка',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Error'),
                    new OAT\Property(property: 'data', properties: [
                        new OAT\Property(property: 'Message', type: 'string', format: 'string', example: 'syntax error, unexpected token "}"'),
                        new OAT\Property(property: 'Info', ref: '#/components/schemas/Error'),
                    ])
                ])
            ),
        ],
        parameters: [new OAT\RequestBody(ref: "#/components/requestBodies/FilmGetRequest")]
    )]
    function getList($request){
        if($request->input('order') !== null) return SessionResource::collection(FilmsSessions::select()->orderBy('film_start', $request->input('order'))->get());
        else return SessionResource::collection(FilmsSessions::all());
    }

    #[OAT\Get(
        path: '/film_session/{session_id}',
        summary: 'Получение одного сеанса фильма',
        description: 'Получение одного сеанса фильма',
        tags: ['film_session'],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Успешно',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Successfully'),
                    new OAT\Property(property: 'data', type: 'array', items: new OAT\Items(ref: '#/components/schemas/SessionResource'))
                ])
            ),
            new OAT\Response(
                response: 500,
                description: 'Ошибка',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Error'),
                    new OAT\Property(property: 'data', properties: [
                        new OAT\Property(property: 'Message', type: 'string', format: 'string', example: 'syntax error, unexpected token "}"'),
                        new OAT\Property(property: 'Info', ref: '#/components/schemas/Error'),
                    ])
                ])
            ),
        ],
        parameters: [new OAT\RequestBody(ref: "#/components/requestBodies/FilmGetRequest")]
    )]
    function getOne(string $id){
        $filmsSessions = new FilmsSessions;
        return SessionResource::collection([$filmsSessions->find($id)]);
    }

    #[OAT\Post(
        path: '/film_session',
        summary: 'Создание сеанса',
        description: 'Создание сеанса',
        tags: ['film_session'],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Успешно',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Successfully'),
                    new OAT\Property(property: 'data', properties: [
                        new OAT\Property(property: 'id', type: 'int', format: 'int', example: 1),
                    ])
                ])
            ),
            new OAT\Response(
                response: 500,
                description: 'Ошибка',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Error'),
                    new OAT\Property(property: 'data', properties: [
                        new OAT\Property(property: 'Message', type: 'string', format: 'string', example: 'syntax error, unexpected token "}"'),
                        new OAT\Property(property: 'Info', ref: '#/components/schemas/Error'),
                    ])
                ])
            ),
        ],
        parameters: [new OAT\RequestBody(ref: "#/components/requestBodies/SessionSaveRequest")]
    )]
    function save($request){
        $id = FilmsSessions::insertGetId($request->all());
        
        return [
            'id'=>$id,
        ];
    }

    #[OAT\Patch(
        path: '/film_session',
        summary: 'Изменение сеанса. На самом деле это постзапрос с параметром в теле запроса method=patch',
        description: 'Изменение сеанса. На самом деле это постзапрос с параметром в теле запроса method=patch',
        tags: ['film_session'],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Успешно',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Successfully'),
                    new OAT\Property(property: 'data', properties: [
                        new OAT\Property(property: 'id', type: 'int', format: 'int', example: 1),
                    ])
                ])
            ),
            new OAT\Response(
                response: 500,
                description: 'Ошибка',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Error'),
                    new OAT\Property(property: 'data', properties: [
                        new OAT\Property(property: 'Message', type: 'string', format: 'string', example: 'syntax error, unexpected token "}"'),
                        new OAT\Property(property: 'Info', ref: '#/components/schemas/Error'),
                    ])
                ])
            ),
        ],
        parameters: [new OAT\RequestBody(ref: "#/components/requestBodies/SessionChangeRequest")]
    )]
    function change($request){
        $id = $request->input('id');
        FilmsSessions::where('id', $id)->update($request->all());
        
        return [
            'id'=>$id,
        ];
    }

    #[OAT\Delete(
        path: '/film_session',
        summary: 'Удаление сеанса. На самом деле это постзапрос с параметром в теле запроса method=delete',
        description: 'Удаление сеанса. На самом деле это постзапрос с параметром в теле запроса method=delete',
        tags: ['film_session'],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Успешно',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Successfully'),
                    new OAT\Property(property: 'data', properties: [
                        new OAT\Property(property: 'id', type: 'int', format: 'int', example: 1),
                    ])
                ])
            ),
            new OAT\Response(
                response: 500,
                description: 'Ошибка',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Error'),
                    new OAT\Property(property: 'data', properties: [
                        new OAT\Property(property: 'Message', type: 'string', format: 'string', example: 'syntax error, unexpected token "}"'),
                        new OAT\Property(property: 'Info', ref: '#/components/schemas/Error'),
                    ])
                ])
            ),
        ],
        parameters: [new OAT\RequestBody(ref: "#/components/requestBodies/SessionDeleteRequest")]
    )]
    function delete($request){
        $id = $request->input('id');
        FilmsSessions::find($id)->delete();
        
        return [
            'id'=>$id,
        ];
    }
}