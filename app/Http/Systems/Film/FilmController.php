<?php
namespace App\Http\Systems\Film;

use App\Http\Systems\Film\Resource\FilmResource;
use App\Http\Source\Controller;
use App\Models\Films;
use Illuminate\Support\Str;
use OpenApi\Attributes as OAT;


class FilmController extends Controller{
    

    #[OAT\Get(
        path: '/film',
        summary: 'Получение списка фильмов',
        description: 'Получение списка фильмов',
        tags: ['film'],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Успешно',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Successfully'),
                    new OAT\Property(property: 'data', type: 'array', items: new OAT\Items(ref: '#/components/schemas/FilmResource'))
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
        if($request->input('order') !== null) return FilmResource::collection(Films::select()->orderBy('id', $request->input('order'))->get());
        else return FilmResource::collection(Films::all());
    }

    #[OAT\Get(
        path: '/film/{film_id}',
        summary: 'Получение одного фильма',
        description: 'Получение одного фильма',
        tags: ['film'],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Успешно',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'status', type: 'string', format: 'string', example: 'Successfully'),
                    new OAT\Property(property: 'data', type: 'array', items: new OAT\Items(ref: '#/components/schemas/FilmResource'))
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
        $films = new Films;
        return FilmResource::collection([$films->find($id)]);
    }

    #[OAT\Post(
        path: '/film',
        summary: 'Создание фильма',
        description: 'Создание фильма',
        tags: ['film'],
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
        parameters: [new OAT\RequestBody(ref: "#/components/requestBodies/FilmSaveRequest")]
    )]
    function save($request){
        $file = $request->file('photo');
        $file_name = Str::random(10).'.'.$file->getClientOriginalExtension();
        $file->storeAs('files', $file_name);

        $id = Films::insertGetId(['photo'=>$file_name] + $request->all());
        
        return [
            'id'=>$id,
        ];
    }


    #[OAT\Patch(
        path: '/film',
        summary: 'Изменение фильма. На самом деле это постзапрос с параметром в теле запроса method=patch',
        description: 'Изменение фильма. На самом деле это постзапрос с параметром в теле запроса method=patch',
        tags: ['film'],
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
        parameters: [new OAT\RequestBody(ref: "#/components/requestBodies/FilmChangeRequest")]
    )]
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


    #[OAT\Delete(
        path: '/film',
        summary: 'Удаление фильма. На самом деле это постзапрос с параметром в теле запроса method=delete',
        description: 'Удаление фильма. На самом деле это постзапрос с параметром в теле запроса method=delete',
        tags: ['film'],
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
        parameters: [new OAT\RequestBody(ref: "#/components/requestBodies/FilmDeleteRequest")]
    )]
    function delete($request){
        $id = $request->input('id');
        $films = Films::find($id);

        $films->FilmsSessions()->delete();
        $films->delete();
        
        return [
            'id'=>$id,
        ];
    }
}