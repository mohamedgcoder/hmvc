<?php

namespace Module\Settings\Data;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Module\Settings\Http\Controllers\Web\Panel\SettingsController;

class Data{

    public static function getSettings()
    {
        $appName = (DB::connection()->getName() == 'tenant')? DB::getDatabaseName() : env('APP_NAME');
        $domain = (DB::connection()->getName() == 'tenant')? Str::lower($appName).'.'.env('APP_NAME').'.'.Str::lower(env('APP_DOMAIN')) : Str::lower(env('APP_DOMAIN'));

        return [
            'settings' => [
                // identity
                [
                    'key' => 'name',
                    'value' => [
                        'en' => $appName,
                    ],
                    'translation' => true,
                ],
                // system
                [
                    'key' => 'system_key',
                    'value' => SettingsController::generateSystemKey(),
                    'translation' => false,
                ],
                [
                    'key' => 'secret_key',
                    'value' => SettingsController::generateSecretKey(),
                    'translation' => false,
                ],
                [
                    'key' => 'domain',
                    'value' => $domain,
                    'translation' => false,
                ],
                [
                    'key' => 'debug',
                    'value' => true,
                    'translation' => false,
                ],
                [
                    'key' => 'env',
                    'value' => 'local',
                    'translation' => false,
                ],
                [
                    'key' => 'timezone',
                    'value' => 'Africa/Cairo',
                    'translation' => false,
                ],
                [
                    'key' => 'expiration_logged_in',
                    'value' => 30,
                    'translation' => false,
                ],
                [
                    'key' => 'expiration_reset_password',
                    'value' => 30,
                    'translation' => false,
                ],
                [
                    'key' => 'cache_remember_time',
                    'value' => 10000,
                    'translation' => false,
                ],
                [
                    // api pagination For Front site only
                    'key' => 'api_pagination',
                    'value' => 0,
                    'translation' => false,
                ],
                [
                    // web pagination For Front site only
                    'key' => 'web_pagination',
                    'value' => 0,
                    'translation' => false,
                ],
                // appearance
                [
                    // title separation (| - or other )
                    'key' => 'title_separation',
                    'value' => '|',
                    'translation' => false,
                ],
                [
                    // Theme name For Front site
                    'key' => 'front_theme',
                    'value' => 'default',
                    'translation' => false,
                ],
                [
                    // Theme name For panel
                    'key' => 'panel_theme',
                    'value' => 'default',
                    'translation' => false,
                ],
                /**
                 * for theme or appearance settings
                 * Main Button
                 */
                [
                    // Navbar Color for admin and customer panel
                    'key' => 'navbar_color',
                    'value' => '#157a77',
                    'translation' => false,
                ],
                [
                    // Main Color
                    'key' => 'main_color',
                    'value' => '#157a77',
                    'translation' => false,
                ],
                [
                    // Button Color
                    'key' => 'main_button',
                    'value' => '#ffffff',
                    'translation' => false,
                ],
                [
                    // Border Color
                    'key' => 'border_color',
                    'value' => '#D21515',
                    'translation' => false,
                ],
                [
                    // Hover color
                    'key' => 'hover_color',
                    'value' => '#D21515',
                    'translation' => false,
                ],
                [
                    // Focus color
                    'key' => 'focus_color',
                    'value' => '#D21515',
                    'translation' => false,
                ],
                [
                    // Text color
                    'key' => 'text_color',
                    'value' => '#D21515',
                    'translation' => false,
                ],
                [
                    // Text hover color
                    'key' => 'text_hover_color',
                    'value' => '#ffffff',
                    'translation' => false,
                ],
                [
                    // Logo Color for default logo (system name)
                    'key' => 'logo_color',
                    'value' => '#ffffff',
                    'translation' => false,
                ],
                // seo
                [
                    // slogan For Front site only
                    'key' => 'slogan',
                    'value' => [
                        'en' => $appName,
                    ],
                    'translation' => true,
                ],
                [
                    // Description For Front site only
                    'key' => 'description',
                    'value' => [
                        'en' => $appName,
                    ],
                    'translation' => true,
                ],
                [
                    // Keywords For Front site only
                    'key' => 'keywords',
                    'value' => [
                        'en' => Str::lower($appName).',system',
                        'ar' => Str::lower($appName).',نظام',
                    ],
                    'translation' => true,
                ],
                // google_map
                [
                    'key' => 'google_map_key',
                    'value' => '',
                    'translation' => false,
                ],
                // notifications
                [
                    'key' => 'firebase_secret_key',
                    'value' => '',
                    'translation' => false,
                ],
                [
                    'key' => 'fcm_topic',
                    'value' => '',
                    'translation' => false,
                ],
            ],
        ];
    }

    public static function getMenu()
    {
        return [
            [
                // if new group will be array else will be id of group
                'group' => [
                    'name' => 1, // array of name or group id
                    'module' => 'settings',
                    'type' => 'admin',
                    'arrangement' => 0, // no arrangement if related to group id
                ],
                'items' => [
                    [
                        'url' => null,
                        'name' => [
                            'en' => 'settings',
                            'ar' => 'الإعدادات',
                        ],
                        'children' => [
                            [
                                'url' => 'general',
                                'children' => null,
                                'icon' => 'fas fa-cogs',
                                'name' => [
                                    'en' => 'general',
                                    'ar' => 'إعدادات عامة',
                                ],
                                'arrangement' => 1,
                            ],
                            // [
                            //     'url' => 'appearance',
                            //     'children' => null,
                            //     'icon' => 'fas fa-theater-masks',
                            //     'name' => [
                            //         'en' => 'appearance',
                            //         'ar' => 'المظهر العام',
                            //     ],
                            //     'arrangement' => 1,
                            // ],
                            // [
                            //     'url' => 'system',
                            //     'children' => null,
                            //     'icon' => 'fas fa-wrench',
                            //     'name' => [
                            //         'en' => 'system',
                            //         'ar' => 'معلومات النظام',
                            //     ],
                            //     'arrangement' => 1,
                            // ],
                            // [
                            //     'url' => 'seo',
                            //     'children' => null,
                            //     'icon' => 'fab fa-searchengin',
                            //     'name' => [
                            //         'en' => 'seo',
                            //         'ar' => 'محركات البحث',
                            //     ],
                            //     'arrangement' => 1,
                            // ],
                            // [
                            //     'url' => 'social',
                            //     'children' => null,
                            //     'icon' => 'fas fa-share-alt',
                            //     'name' => [
                            //         'en' => 'social',
                            //         'ar' => 'التواصل الاجتماعي',
                            //     ],
                            //     'arrangement' => 1,
                            // ],
                            // [
                            //     'url' => 'security',
                            //     'children' => null,
                            //     'icon' => 'fas fa-key',
                            //     'name' => [
                            //         'en' => 'security',
                            //         'ar' => 'الحماية',
                            //     ],
                            //     'arrangement' => 1,
                            // ],
                            // [
                            //     'url' => 'integrations',
                            //     'children' => null,
                            //     'icon' => 'fas fa-link',
                            //     'name' => [
                            //         'en' => 'integrations',
                            //         'ar' => 'الربط الخارجى',
                            //     ],
                            //     'arrangement' => 1,
                            // ],
                        ],
                        'icon' => 'fas fa-sliders-h',
                        'arrangement' => 1,
                    ],
                ],
            ],
        ];
    }
}
