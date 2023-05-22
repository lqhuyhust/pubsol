<?php

namespace App\plugins\tag\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'tag_manager', 'tag_read'
        ];
    }

    public static function registerPermission()
    {
        return [
            'tags' => [
                'get' => ['tag_manager' , 'tag_read'],
                'post' => ['tag_manager' , 'tag_read'],
                'put' => ['tag_manager' , 'tag_update'],
                'delete' => ['tag_manager' , 'tag_delete']
            ],
            'tag' => [
                'get' => ['tag_manager' , 'tag_read'],
                'post' => ['tag_manager' , 'tag_create'],
                'put' => ['tag_manager' , 'tag_update'],
                'delete' => ['tag_manager' , 'tag_delete']
            ],
        ];
    }
}
