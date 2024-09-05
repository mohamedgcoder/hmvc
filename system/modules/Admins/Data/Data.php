<?php

namespace Module\Admins\Data;

class Data
{

    public static function getData()
    {
        return [
            'owner',
            'ceo',
            'general manager',
            'developer'
        ];
    }

    public static function getMenu()
    {
        return [
            [
                // if new group will be array else will be id of group
                'group' => [
                    'name' => [ // array of name or group id
                        'en' => 'main',
                        'ar' => 'الرئيسية',
                    ],
                    'module' => 'admins',
                    'type' => 'admin',
                    'arrangement' => 1,
                ],
                'items' => [
                    [
                        'url' => 'panel',
                        'name' => [
                            'en' => 'dashboard',
                            'ar' => 'لوحة التحكم',
                        ],
                        'children' => null,
                        'icon' => 'fas fa-tachometer-alt',
                        'arrangement' => 1,
                    ],
                    [
                        'url' => 'index',
                        'name' => [
                            'en' => 'admins',
                            'ar' => 'المشرفين',
                        ],
                        'children' => null,
                        'icon' => 'fas icon-user-tie',
                        'arrangement' => 2,
                    ]
                ],
            ],
        ];
    }
}
