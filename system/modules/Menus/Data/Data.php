<?php

namespace Module\Menus\Data;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Data
{

    public static function getSettings()
    {
        return [
        ];
    }

    public static function getMenu()
    {
        return [
            [
                // if new group will be array else will be id of group
                'group' => [
                    'name' => 6, // array of name or group id
                    'module' => 'menus',
                    'type' => 'admin',
                    'arrangement' => 0, // no arrangement if related to group id
                ],
                'items' => [
                    [
                        'url' => 'menus',
                        'name' => [
                            'en' => 'menus',
                            'ar' => 'القوائم',
                        ],
                        'children' => null,
                        'icon' => 'fab fa-elementor',
                        'arrangement' => 3,
                    ],
                ],
            ],
        ];
    }
}
