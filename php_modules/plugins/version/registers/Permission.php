<?php

namespace App\plugins\version\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'version_manager', 'version_read', 'version_create', 'version_update', 'version_delete' 
        ];
    }

    public static function registerPermission()
    {
        return [
            'versions' => [
                'get' => ['version_manager', 'version_read'],
                'post' => ['version_manager', 'version_read'],
                'put' => ['version_manager', 'version_update'],
                'delete' => ['version_manager', 'version_delete']
            ],
            'version' => [
                'get' =>  ['version_manager', 'version_read'],
                'post' =>  ['version_manager', 'version_create'],
                'put' =>  ['version_manager', 'version_update'],
                'delete' =>  ['version_manager', 'version_delete']
            ],
            'version-feedback' => [
                'get' =>  ['version_manager', 'version_read'],
                'post' =>  ['version_manager', 'version_read'],
            ],
            'setting-version'=>[
                'get' => ['version_manager'],
                'post' => ['version_manager'],
            ],
        ];
    }
}
