<?php

namespace Module\Languages\Data;

class Data{

    public static function getLanguages()
    {
        return [
            ['arrangement' => 1, 'code' => 'en', 'flag' => 'gb', 'direction' => 'ltr', 'status' => 2],
            ['arrangement' => 2, 'code' => 'ar', 'flag' => 'eg', 'direction' => 'rtl', 'status' => 2],
        ];
    }

    public static function getTranslations()
    {
        return [
            [
                ['name' => 'english', 'lang_code' => 'en'],
                ['name' => 'الانجليزيه', 'lang_code' => 'ar'],
            ],
            [
                ['name' => 'arabic', 'lang_code' => 'en'],
                ['name' => 'العربية', 'lang_code' => 'ar'],
            ],
            [
                ['name' => 'french', 'lang_code' => 'en'],
                ['name' => 'الفرنسية', 'lang_code' => 'ar'],
            ],
            [
                ['name' => 'Türk', 'lang_code' => 'tr'],
                ['name' => 'التركية', 'lang_code' => 'ar'],
            ],
        ];
    }

    public static function getSettings()
    {
        $languages = '';
        foreach (self::getLanguages() as $k => $gl) {
            $languages = $languages.(($k == 0)?'':',').$gl['code'];
        }

        return [
            'language' => [
                [
                    'key' => 'available_locales',
                    'value' => $languages,
                    'translation' => false,
                ],
                [
                    'key' => 'default',
                    'value' => env('APP_LANGUAGE'),
                    'translation' => false,
                ],
            ]
        ];
    }

    public static function getMenu()
    {
        return [
            [
                // if new group will be array else will be id of group
                'group' => [
                    'name' => [ // array of name or group id
                        'en' => 'settings',
                        'ar' => 'الإعدادات',
                    ],
                    'module' => 'languages',
                    'type' => 'admin',
                    'arrangement' => 5,
                ],
                'items' => [
                    [
                        'url' => null,
                        'name' => [
                            'en' => 'languages',
                            'ar' => 'اللغات',
                        ],
                        'children' => [
                            [
                                'url' => 'locales',
                                'children' => null,
                                'icon' => null,
                                'name' => [
                                    'en' => 'locales',
                                    'ar' => 'اللغات',
                                ],
                                'arrangement' => 1,
                            ],
                            [
                                'url' => 'translations',
                                'children' => null,
                                'icon' => null,
                                'name' => [
                                    'en' => 'translations',
                                    'ar' => 'الترجمات',
                                ],
                                'arrangement' => 1,
                            ],
                        ],
                        'icon' => 'fas fa-language',
                        'arrangement' => 2,
                    ]
                ],
            ],
        ];
    }
}
