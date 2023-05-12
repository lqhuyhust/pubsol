<?php

namespace App\plugins\tag\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'tags' => [
                'fnc' => [
                    'get' => 'tag.tag.list',
                    'post' => 'tag.tag.list',
                    'put' => 'tag.tag.update',
                    'delete' => 'tag.tag.delete'
                ]
            ],
            'tag' => [
                'fnc' => [
                    'get' => 'tag.tag.detail',
                    'post' => 'tag.tag.add',
                    'put' => 'tag.tag.update',
                    'delete' => 'tag.tag.delete'
                ],
                'parameters' => ['id'],
            ],
        ];
    }
}
