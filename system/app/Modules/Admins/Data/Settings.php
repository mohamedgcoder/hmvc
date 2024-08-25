<?php

namespace Admins\Data;

class Settings
{
    public static function getSettings()
    {
        return [
            'prefix' => [
                [
                    'key' => 'panel',
                    'value' => 'panel',
                    'translation' => false,
                ]
            ],
            'admin' => [
                [
                    'key' => 'password_length',
                    'value' => 6,
                    'translation' => false,
                ],
                [
                    'key' => 'request_update_profile',
                    'value' => true,
                    'translation' => false,
                ],
            ]
        ];
    }
}
