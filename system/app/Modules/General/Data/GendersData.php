<?php

namespace General\Data;

class GendersData{

    public static function getGenders()
    {
        return [
            'global' => [
                ['en' => 'male', 'ar' => 'ذكر'],
                ['en' => 'female', 'ar' => 'أنثى']
            ]
        ];
    }
}
