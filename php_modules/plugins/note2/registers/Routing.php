<?php

namespace App\plugins\note2\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'notes' => [
                'fnc' => [
                    'get' => 'note2.note.list',
                    'post' => 'note2.note.list',
                    'put' => 'note2.note.update',
                    'delete' => 'note2.note.delete',
                ]
            ],
            'note2/detail' => [
                'fnc' => [
                    'get' => 'note2.note.detail',
                ],
                'parameters' => ['id'],
                'loadChildPlugin' => true,
                'permissionGroup' => true,
                'permission' => [
                    'get' => ['note_manager', 'note_read'],
                ],
            ],
            'note2/edit' => [
                'fnc' => [
                    'get' => 'note2.note.form',
                    'put' => 'note2.note.update',
                ],
                'parameters' => ['id'],
                'loadChildPlugin' => true,
                'permission' => [
                    'get' => ['note_manager', 'note_update'],
                ],
            ],
            'note2/preview' => [
                'fnc' => [
                    'get' => 'note2.note.preview',
                ],
                'parameters' => ['id'],
                'loadChildPlugin' => true,
                'permissionGroup' => true,
                'permission' => [
                    'get' => ['note_manager', 'note_read'],
                ],
            ],
            'note2/search' => [
                'fnc' => [
                    'get' => 'note2.note.search',
                ]
            ],
            'new-note2' => [
                'fnc' => [
                    'get' => 'note2.note.newform',
                    'post' => 'note2.note.add',
                ],
                'parameters' => ['type'],
                'loadChildPlugin' => true,
                'permission' => [
                    'get' => ['note_manager', 'note_read'],
                    'post' => ['note_manager', 'note_create'],
                    'put' => ['note_manager', 'note_update'],
                    'delete' => ['note_manager', 'note_delete']
                ],
            ],
        ];
    }
}
