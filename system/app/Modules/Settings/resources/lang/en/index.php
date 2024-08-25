<?php

return [
    'title' => 'setings',

    'general' => [
        'title' => 'general',
        'dark_mode' => 'dark mode',
    ],

    'identity' => [
        'title' => 'identity',
        'header' => 'identity settings',
        'name' => 'name',
        'name-placeholder' => 'name',
        'address' => 'address',
        'address-placeholder' => 'address',
    ],

    'appearance' => [
        'title' => 'appearance',
        'header' => 'appearance settings',
        'title_separation' => 'title separation',
        'color' => 'color',
        'color-note' => 'must click on choose to set color in settings',
        'logo_color' => 'logo color',
        'button_color' => 'main button',
        'main_color' => 'main',
        'navbar_color' => 'navbar',
        'border_color' => 'border',
        'hover_color' => 'hover',
        'focus_color' => 'focus',
        'text_color' => 'text',
        'text_hover_color' => 'text hover',
        '' => '',
    ],

    'system' => [
        'title' => 'system',
        'header' => 'system settings',
        'domain' => 'domain',
        'debug' => 'debug',
        'debug_note' => 'for development',
        'env' => 'system environment',
        'env_note' => 'local: This is typically used during development on a developer’s local machine. When set to local, <code>SYSTEM</code> may display more debugging information and enable certain features that are useful during development.
                <br/>production: When the application is live and being used by end-users, <code>APP_ENV</code> should be set to production. In this mode, error messages are suppressed or minimized to avoid exposing sensitive information.
                <br/>staging: This is often used for a pre-production environment that mirrors the production environment as closely as possible. It’s used for final testing before deploying to production.
                <br/>testing: This environment is used when running automated tests, such as <code>PHPUnit</code> tests or <code>Dusk</code> browser tests. <code>SYSTEM</code> is configured to use different settings that are optimized for testing environments.',
        'timezone' => 'timezone',
        'select your timezone' => 'select your timezone',
        'expiration_logged_in' => 'logged in session expire after',
        'expiration_logged_in_note' => 'in secounds',
        'expiration_reset_password' => 'reset password session expire after',
        'api_pagination' => 'api pagination count',
        'api_pagination_note' => '0 mean no pagination',
        'web_pagination' => 'web pagination count',
        'web_pagination_note' => '0 mean no pagination',
        'local' => 'local',
        'production' => 'production',
        'staging' => 'staging',
        'testing' => 'testing',
    ],

    'mobile' => [
        'title' => 'mobile',
        'header' => 'mobile settings',
    ],

    'seo' => [
        'title' => 'seo',
        'header' => 'seo settings',
        'slogan' => 'slogan',
        'slogan-placeholder' => 'write your system slogan',
        'description' => 'description',
        'description-placeholder' => 'Describe your app',
        'keywords' => 'keywords',
        'keywords-def' => 'you can add keywords define your seo system, and separate it by enter',
    ],

    'social' => [
        'title' => 'social links',
        'header' => 'social links settings',
    ],

    'security' => [
        'title' => 'security',
        'header' => 'security settings',
        'api_integrations' => 'api integrations',
        'system_key' => 'system key',
        'secret_key' => 'secret key',
    ],

    'integrations' => [
        'title' => 'integrations',
        'header' => 'integrations settings',
        'mail' => 'mail',
        'transport' => 'transport',
        'host' => 'host',
        'port' => 'port',
        'timeout' => 'timeout',
        'queue_delay' => 'queue delay',
        'encryption' => 'encryption',
        'user_name' => 'user name',
        'password' => 'password',
        'firebase' => 'firebase',
        'firebase_secret_key' => 'firebase secret key',
        'fcm_topic' => 'fcm topic',
        'google' => 'google',
        'google_map_key' => 'google map key',
    ],

];
