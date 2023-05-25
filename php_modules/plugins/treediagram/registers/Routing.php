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
                ],
                'permission' => [
                    'get' => ['treediagram_manager', 'treediagram_read'],
                    'post' => ['treediagram_manager', 'treediagram_read'],
                    'put' => ['treediagram_manager', 'treediagram_update'],
                    'delete' => ['treediagram_manager', 'treediagram_delete']
                ],
            ],
            'tree-diagram' => [
                'fnc' => [
                    'get' => 'treediagram.treediagram.detail',
                    'post' => 'treediagram.treediagram.add',
                    'put' => 'treediagram.treediagram.update',
                    'delete' => 'treediagram.treediagram.delete'
                ],
                'parameters' => ['id'],
                'permission' => [
                    'get' => ['treediagram_manager', 'treediagram_read'],
                    'post' => ['treediagram_manager', 'treediagram_create'],
                    'put' => ['treediagram_manager', 'treediagram_update'],
                    'delete' => ['treediagram_manager', 'treediagram_delete']
                ],
            ],
        ];
    }
}
