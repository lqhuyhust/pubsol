<?php 

return [
    'admin' => [
        // Endpoint Milestones
        'milestones'=>[
            'fnc' => [
                'get' => 'milestone.milestone.list',
                'post' => 'milestone.milestone.list',
                'put' => 'milestone.milestone.update',
                'delete' => 'milestone.milestone.delete'
            ],
        ],
        'requests' => [
            'fnc' => [
                'get' => 'milestone.request.list',
                'post' => 'milestone.request.list',
                'put' => 'milestone.request.update',
                'delete' => 'milestone.request.delete'
            ],
            'parameters' => ['id'],
        ],
        'request' => [
            'fnc' => [
                'get' => 'milestone.request.detail',
                'post' => 'milestone.request.add',
                'put' => 'milestone.request.update',
                'delete' => 'milestone.request.delete'
            ],
            'parameters' => ['milestone_id','id'],
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
