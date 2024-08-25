<?php

namespace General\Data;

class Plugin
{
    public static function getPluginData()
    {
        return [
            'group' => 'settings',
                'global_name' => 'general',
                'name'=> [
                    'en'=> 'general',
                    'ar'=> 'العامة'
                ],
                'description'=> [
                    'en'=> 'description of general',
                    'ar'=> 'وصف العامة'
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
