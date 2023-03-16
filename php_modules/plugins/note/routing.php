<?php 

return [
    'notes' => [
        'fnc' => [
            'get' => 'note.note.list',
            'post' => 'note.note.list',
            'put' => 'note.note.update',
            'delete' => 'note.note.delete'
        ]
    ],
    'note-diagrams' => [
        'fnc' => [
            'get' => 'note.notediagram.list',
            'post' => 'note.notediagram.list',
            'put' => 'note.notediagram.update',
            'delete' => 'note.notediagram.delete'
        ]
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
    'note-diagram' => [
        'fnc' => [
            'get' => 'note.notediagram.detail',
            'post' => 'note.notediagram.add',
            'put' => 'note.notediagram.update',
            'delete' => 'note.notediagram.delete'
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
