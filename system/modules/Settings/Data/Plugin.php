<?php

namespace Module\Settings\Data;

class Plugin
{
    public static function getPluginData()
    {
        return [
            'group' => 'settings',
                'global_name' => 'settings',
                'name'=> [
                    'en'=> 'settings',
                    'ar'=> 'الإعدادات'
                ],
                'description'=> [
                    'en'=> 'description of settings',
                    'ar'=> 'وصف الإعدادات'
                ],
                'version'=> '0.0.1', // ex. XXX.XXX.XXX
                'image'=> '',
                'video'=> '',
                'link'=> '',
                'licensable' => false,
                'tenancy' => true,
                'core'=> true,
                'featured'=> false,
                'rating'=> 5.0,
                'num_of_installations' => 1,
                'status'=> 2,
                'author' => "Mohamed Coder",
        ];
    }
}
