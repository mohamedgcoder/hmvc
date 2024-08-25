<?php

use Illuminate\Support\Str;

return [
    'module' => [
        'name' => basename(dirname(__DIR__, 1)),
        'prefix' => Str::lower(basename(dirname(__DIR__, 1))),
    ],
    'middleware' => [
        'Panel' => [
            'web' => [
                'guest' => [
                    'guest:admin'
                ],
                'auth' => [
                    //
                ],
                'tenant' => env("APP_TENANCY")
            ],
            'api' => [
                'guest' => [
                    //
                ],
                'auth' => [
                    //
                ],
                'tenant' => env("APP_TENANCY")
            ],
        ],
        'Front' => [
            'web' => [
                'guest' => [
                    //
                ],
                'auth' => [
                    //
                ],
                'tenant' => env("APP_TENANCY")
            ],
            'api' => [
                'guest' => [
                    'api.auth'
                ],
                'auth' => [
                    'api.auth'
                ],
                'tenant' => env("APP_TENANCY")
            ],
        ],
    ],
    'routes' => [
        'Panel' => [
            'web' => true,
            'api' => false,
        ],
        'Front' => [
            'web' => false,
            'api' => false,
        ],
    ]
];
