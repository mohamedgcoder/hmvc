<?php

namespace Module\Permissions\Data;

class RolesData{

    public static function getRoles()
    {
        return [
            'owner',
            'ceo',
            'general manager',
            'manager',
            'supervisor',
            'developer',
            'content manager',
            'team member',
            'financial manager',
            'account manager',
            'accountant',
            'marketing manager',
            'marketing',
            'hr manager',
            'hr',
            'technical account',
            'technical support',
        ];
    }
}
