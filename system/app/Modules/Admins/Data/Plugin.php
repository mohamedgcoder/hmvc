<?php

namespace Admins\Data;

class Plugin
{
    public static function getPluginData()
    {
        return [
            'group' => 'main',
                'global_name' => 'admins',
                'name'=> [
                    'en'=> 'admins',
                    'ar'=> 'المشرفين'
                ],
                'description'=> [
                    'en'=> 'description of admins',
                    'ar'=> 'وصف المشرفين'
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