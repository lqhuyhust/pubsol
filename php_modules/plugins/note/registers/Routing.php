<?php

namespace App\plugins\note\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'notes' => [
                'fnc' => [
                    'get' => 'note.note.list',
                    'post' => 'note.note.list',
                    'put' => 'note.note.update',
                    'delete' => 'note.note.delete'
                ]
            ],
            'note/search' => [
                'fnc' => [
                    'get' => 'note.note.search',
                ]
            ],
            'note/request' => [
                'fnc' => [
                    'get' => 'note.note.request',
                ],
                'parameters' => ['id'],
            ],
            'attachment' => [
                'fnc' => [
                    'delete' => 'note.attachment.delete'
                ],
                'parameters' => ['id'],
            ],
            'download/attachment' => [
                'fnc' => [
                    'delete' => 'note.attachment.download'
                ],
                'parameters' => ['id'],
            ],
            'note/version' => [
                'fnc' => [
                    'get' => 'note.version.detail',
                    'post' => 'note.version.rollback',
                    'delete' => 'note.version.delete'
                ],
                'parameters' => ['id'],
            ],
            'note/preview' => [
                'fnc' => [
                    'get' => 'note.note.preview',
                ],
                'parameters' => ['id'],
            ],
            'note' => [
                'fnc' => [
                    'get' => 'note.note.detail',
                    'post' => 'note.note.add',
                    'put' => 'note.note.update',
                    'delete' => 'note.note.delete'
                ],
                'parameters' => ['id'],
            ],
            'tag' => [
                'fnc' => [
                    'get' => 'note.tag.list',
                    'post' => 'note.tag.add',
                ]
            ],
            'setting-connections'=>[
                'fnc' => [
                    'get' => 'note.setting.connections',
                    'post' => 'note.setting.connectionsSave',
                ],
            ],
        ];
    }
}
