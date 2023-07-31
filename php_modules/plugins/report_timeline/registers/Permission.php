<?php

namespace App\plugins\report_timeline\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'treephp_manager', 'treephp_read', 'treephp_create', 'treephp_update', 'treephp_delete' 
        ];
    }
}
