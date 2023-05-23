<?php

namespace App\plugins\report\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'report_manager', 'report_read'
        ];
    }

    public static function registerPermission()
    {
        return [
            'reports' => [
                'get' => ['report_manager', 'report_read'],
                'post' => ['report_manager', 'report_read'],
                'put' => ['report_manager', 'report_update'],
                'delete' => ['report_manager', 'report_delete'],
            ],
        ];
    }
}
