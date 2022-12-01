<?php 

return [
    'admin' => [
        // Endpoint User
        'milestones'=>[
            'fnc' => [
                'get' => 'milestone.user.list',
                'post' => 'milestone.milestone.list',
                'put' => 'milestone.milestone.update',
                'delete' => 'milestone.milestone.delete'
            ],
        ],
        'milestone' => [
            'fnc' => [
                'get' => 'milestone.milestone.detail',
                'post' => 'milestone.milestone.add',
                'put' => 'milestone.milestone.update',
                'delete' => 'milestone.milestone.delete'
            ],
            'parameters' => ['id'],
        ],
    ],
];
