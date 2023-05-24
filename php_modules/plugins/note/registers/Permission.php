<?php

namespace App\plugins\note\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'note_manager', 'note_read', 'note_create', 'note_update', 'note_delete',
        ];
    }

    public static function registerPermission()
    {
        return [
            'notes' => [
                'get' => ['note_manager', 'note_read'],
                'post' => ['note_manager', 'note_read'],
                'put' => ['note_manager', 'note_update'],
                'delete' => ['note_manager', 'note_delete']
            ],
            'attachment' => [
                'delete' => ['note_manager', 'note_update']
            ],
            'note/version' => [
                'get' => ['note_manager', 'note_update'],
                'post' => ['note_manager', 'note_update'],
                'delete' => ['note_manager', 'note_update']
            ],
            'note' => [
                'get' => ['note_manager', 'note_read'],
                'post' => ['note_manager', 'note_create'],
                'put' => ['note_manager', 'note_update'],
                'delete' => ['note_manager', 'note_delete']
            ],
            'setting-connections'=>[
                'get' => ['note_manager'],
                'post' => ['note_manager'],
            ],
        ];
    }
}
