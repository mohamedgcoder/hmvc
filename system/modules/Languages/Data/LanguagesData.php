<?php

namespace Module\Languages\Data;

class LanguagesData{

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
                [
                    'key' => 'default_based_on_device',
                    'value' => false,
                    'translation' => false,
                ],
            ]
        ];
    }
}
