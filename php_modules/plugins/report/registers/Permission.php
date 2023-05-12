<?php

namespace App\plugins\report\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'report_manager', 'report_view'
        ];
    }

    public static function registerPermission()
    {
        return [
            'calendar' => [
                'get' => ['calendar_manager', 'calendar_view'],
                'post' => ['calendar_manager', 'calendar_view'],
            ],
        ];
    }
}
