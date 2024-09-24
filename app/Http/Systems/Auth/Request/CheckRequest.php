<?php
namespace App\Http\Systems\Auth\Request;

use OpenApi\Attributes as OAT;
use App\Http\Source\Request;

#[OAT\RequestBody(
    request: 'CheckRequest',
    required: true,
    content: new OAT\JsonContent(properties: [
        new OAT\Property(property: "token", type: "string", format: "string", example: "eyJhbGciOiJzaGEy3rNTYiLCJ0eXAiOiJKV1QifQ==.eyJ1c2VyIjoxLCJwYXNzIjoiY3R2bXof33e5NzUzMSIsImlhdCI6MTcyMDgwNDc1MywiZXh0YSI6MTcyMDg5MTE1MywiZXh0ciI6MTcyMDk3NzU1M30=.ee67049b1dag4898ea60273659487ef0c4e252c610fcfb0fd92bc02138edbf65a1", schema: "required|string"),
    ])
)]
class CheckRequest extends Request{

    function rules(): array
    {
        return [
            'token' => 'required|string',
        ];
    }
}