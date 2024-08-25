<?php

use Illuminate\Support\Str;

return [
    "module" => [
        "name" => basename(dirname(__DIR__, 1)),
        "prefix" => Str::lower(basename(dirname(__DIR__, 1))),
    ],
    "middleware" => [
        "Panel" => [
            "web" => [
                'guest' => [
                    'guest:agent'
                ],
                'auth' => [
                    'auth:admin'
                ],
                'tenant' => env("APP_TENANCY")
            ],
            "api" => [
                "guest" => [
                    'api.auth'
                ],
                "auth" => [
                    'api.auth', 'admin:api'
                ],
                'tenant' => env("APP_TENANCY")
            ],
        ],
        "Front" => [
            "web" => [
                "guest" => [
                    //
                ],
                "auth" => [
                    //
                ],
                'tenant' => env("APP_TENANCY")
            ],
            "api" => [
                "guest" => [
                    'api.auth'
                ],
                "auth" => [
                    'api.auth', 'user:api'
                ],
                'tenant' => env("APP_TENANCY")
            ],
        ],
    ],
    "routes" => [
        "Panel" => [
            "web" => true,
            "api" => true,
        ],
        "Front" => [
            "web" => false,
            "api" => true,
        ],
    ]
];
