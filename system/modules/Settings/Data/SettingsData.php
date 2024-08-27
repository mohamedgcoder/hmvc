<?php

namespace Module\Settings\Data;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Module\Settings\Http\Controllers\Web\Panel\SettingsController;

class SettingsData{

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
}
