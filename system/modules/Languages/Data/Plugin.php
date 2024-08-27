<?php

namespace Module\Languages\Data;

class Plugin
{
    public static function getPluginData()
    {
        return [
            'group' => 'main',
                'global_name' => 'languages',
                'name'=> [
                    'en'=> 'languages',
                    'ar'=> 'اللغات'
                ],
                'description'=> [
                    'en'=> 'description of languages',
                    'ar'=> 'وصف اللغات'
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
