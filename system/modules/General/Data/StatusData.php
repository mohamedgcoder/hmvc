<?php

namespace Module\General\Data;

class StatusData{

    public static function getStatus()
    {
        return [
            'global' => [
                ['en' => 'pending', 'ar' => 'قيد الانتظار'],
                ['en' => 'active', 'ar' => 'نشط'],
                ['en' => 'inactive', 'ar' => 'غير نشط'],
                ['en' => 'suspended', 'ar' => 'معطل']
            ]
        ];
    }
}
