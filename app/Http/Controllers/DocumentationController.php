<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\OpenApi(
    openapi: '3.0.0',
    info: new OA\Info(
        title: 'Weroad Api test',
        version: '1.0.0',
        description: 'API test',
        contact: new OA\Contact(email: 'andu2flo@gmail.com')
    ),
    servers: [
        new OA\Server(
            description: 'API Server',
            url: 'http://localhost:81/api/v1'
        ),
    ]
)]

class DocumentationController
{
}
