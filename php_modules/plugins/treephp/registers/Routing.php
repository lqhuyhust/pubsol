<?php

namespace App\plugins\treephp\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'tree-phps' => [
                'fnc' => [
                    'get' => 'treephp.treediagram.list',
                    'post' => 'treephp.treediagram.list',
                    'put' => 'treephp.treediagram.update',
                    'delete' => 'treephp.treediagram.delete'
                ]
            ],
            'tree-php' => [
                'fnc' => [
                    'get' => 'treephp.treediagram.detail',
                    'post' => 'treephp.treediagram.add',
                    'put' => 'treephp.treediagram.update',
                    'delete' => 'treephp.treediagram.delete'
                ],
                'parameters' => ['id'],
            ],
        ];
    }
}
