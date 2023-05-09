<?php

namespace App\plugins\treediagram\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'tree-diagrams' => [
                'fnc' => [
                    'get' => 'treediagram.treediagram.list',
                    'post' => 'treediagram.treediagram.list',
                    'put' => 'treediagram.treediagram.update',
                    'delete' => 'treediagram.treediagram.delete'
                ]
            ],
            'tree-diagram' => [
                'fnc' => [
                    'get' => 'treediagram.treediagram.detail',
                    'post' => 'treediagram.treediagram.add',
                    'put' => 'treediagram.treediagram.update',
                    'delete' => 'treediagram.treediagram.delete'
                ],
                'parameters' => ['id'],
            ],
        ];
    }
}
