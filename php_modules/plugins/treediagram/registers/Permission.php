<?php

namespace App\plugins\treediagram\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'treediagram_manager', 'treediagram_read', 'treediagram_create', 'treediagram_update', 'treediagram_delete' 
        ];
    }
}
