<?php

namespace Module\Contacts\Data;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Data{

    public static function getSocialMediaApps()
    {
        return [
            'facebook',
            'whatsapp',
            'youTube',
            'instagram',
            'WeChat',
            'tikTok',
            'linkedIn',
            'telegram',
            'snapchat',
            'douyin',
            'kuaishou',
            'weibo',
            'QQ',
            'qzone',
            'tieba',
            'reddit',
            'Pinterest',
            'teams',
            'quora',
            'skype',
            'twitch',
            'line',
            'vevo',
            'tumblr',
            'vK',
        ];
    }

    public static function getContactSettings()
    {
        $appName = (DB::connection()->getName() == 'tenant')? DB::getDatabaseName() : env('APP_NAME');
        $domain = (DB::connection()->getName() == 'tenant')? Str::lower($appName).'.'.env('APP_NAME').'.'.Str::lower(env('APP_DOMAIN')) : env('APP_NAME').'.'.Str::lower(env('APP_DOMAIN'));

        return [
            'contact_form' => [
                [
                    'key' => 'email',
                    'value' => 1,
                    'translation' => false,
                ],
                [
                    'key' => 'name',
                    'value' => 1,
                    'translation' => false,
                ],
                [
                    'key' => 'phone',
                    'value' => false,
                    'translation' => false,
                ],
                [
                    'key' => 'domain',
                    'value' => false,
                    'translation' => false,
                ],
                [
                    'key' => 'subject',
                    'value' => 1,
                    'translation' => false,
                ],
                [
                    'key' => 'message',
                    'value' => 1,
                    'translation' => false,
                ],
            ]
        ];
    }

    public static function getMailSettings()
    {
        $appName = (DB::connection()->getName() == 'tenant')? DB::getDatabaseName() : env('APP_NAME');
        $domain = (DB::connection()->getName() == 'tenant')? Str::lower($appName).'.'.env('APP_NAME').'.'.Str::lower(env('APP_DOMAIN')) : env('APP_NAME').'.'.Str::lower(env('APP_DOMAIN'));

        return [
            'settings' => [
                // mail
                [
                    'key' => 'transport',
                    'value' => 'smtp',
                    'translation' => false,
                ],
                [
                    'key' => 'host',
                    'value' => 'sandbox.smtp.mailtrap.io',
                    'translation' => false,
                ],
                [
                    'key' => 'port',
                    'value' => 587, // ex 25 or 465 or 587 or 2525 for pop3.mailtrap.io - 1100 or 9950
                    'translation' => false,
                ],
                [
                    'key' => 'user_name',
                    'value' => '2580692ee15cf8',
                    'translation' => false,
                ],
                [
                    'key' => 'password',
                    'value' => '0ac23132e3d7df',
                    'translation' => false,
                ],
                [
                    'key' => 'timeout',
                    'value' => Null,
                    'translation' => false,
                ],
                [
                    'key' => 'queue_delay',
                    'value' => 0,
                    'translation' => false,
                ],
                [
                    'key' => 'encryption',
                    'value' => null, // tls
                    'translation' => false,
                ],
                [
                    'key' => 'support_email',
                    'value' => 'support@'.Str::lower($domain),
                    'translation' => false,
                ],
                [
                    'key' => 'technical_email',
                    'value' => 'technical@'.Str::lower($domain),
                    'translation' => false,
                ],
                [
                    'key' => 'no-reply_email',
                    'value' => 'no-reply@'.Str::lower($domain),
                    'translation' => false,
                ],
                [
                    'key' => 'from_name',
                    'value' => Str::lower($appName),
                    'translation' => false,
                ],

                // contact
                [
                    'key' => 'phone',
                    'value' => '',
                    'translation' => false,
                ],
                [
                    'key' => 'phone2',
                    'value' => '',
                    'translation' => false,
                ],
                [
                    'key' => 'fax',
                    'value' => '',
                    'translation' => false,
                ],
                [
                    'key' => 'whatsapp',
                    'value' => '',
                    'translation' => false,
                ],
                [
                    'key' => 'address',
                    'value' => [
                        'en' => '<p>Name Address 13th Street 47 W 13th St, New York,</p>',
                    ],
                    'translation' => true,
                ],
                [
                    'key' => 'location',
                    'value' => null,
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
                    'name' => 6, // array of name or group id
                    'module' => 'contacts',
                    'type' => 'admin',
                    'arrangement' => 0, // no arrangement if related to group id
                ],
                'items' => [
                    [
                        'url' => null,
                        'name' => [
                            'en' => 'contacts',
                            'ar' => 'جهات الاتصال',
                        ],
                        'children' => [
                            [
                                'url' => 'emails',
                                'children' => null,
                                'icon' => 'far fa-envelope',
                                'name' => [
                                    'en' => 'emails',
                                    'ar' => 'الفبريد الإلكترونى',
                                ],
                                'arrangement' => 1,
                            ],
                            [
                                'url' => 'phones',
                                'children' => null,
                                'icon' => 'fas fa-mobile',
                                'name' => [
                                    'en' => 'phones',
                                    'ar' => 'أرقام الهواتف',
                                ],
                                'arrangement' => 1,
                            ],
                        ],
                        'icon' => 'fas fa-address-book',
                        'arrangement' => 4,
                    ]
                ],
            ],
            [
                'group' => [
                    'name' => 1,
                    'module' => 'contacts',
                    'type' => 'admin',
                    'arrangement' => 3,
                ],
                'items' => [
                    [
                        'url' => 'contacts',
                        'name' => [
                            'en' => 'contacts',
                            'ar' => 'إعدادات التواصل',
                        ],
                        'children' => null,
                        'parent' => 10,
                        'icon' => 'fas fa-address-book',
                        'arrangement' => 3,
                    ]
                ],
            ],
        ];
    }
}
