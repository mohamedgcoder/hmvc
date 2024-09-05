<?php

namespace Module\Permissions\Data;

class Data
{
    public static function getMenu()
    {
        return [
            [
                // if new group will be array else will be id of group
                'group' => [
                    'name' => 6, // array of name or group id
                    'module' => 'permissions',
                    'type' => 'admin',
                    'arrangement' => 0, // no arrangement if related to group id
                ],
                'items' => [
                    [
                        'url' => null,
                        'name' => [
                            'en' => 'permissions',
                            'ar' => 'الصلاحيات',
                        ],
                        'children' => [
                            [
                                'url' => 'roles',
                                'children' => null,
                                'icon' => 'icon-user-lock',
                                'name' => [
                                    'en' => 'roles',
                                    'ar' => 'الصلاحيات',
                                ],
                                'arrangement' => 1,
                            ],
                        ],
                        'icon' => 'icon-user-lock',
                        'arrangement' => 2,
                    ]
                ],
            ],
        ];
    }
}
