<?php

namespace Module\General\Data;

class ConnectionTypesData{

    public static function getConnectionTypes()
    {
        return [
            'web',
            'mobile',
            'api'
        ];
    }
}
