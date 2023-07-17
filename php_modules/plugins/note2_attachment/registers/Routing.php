<?php

namespace App\plugins\note2_attachment\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'note/attachment/delete' => [
                'fnc' => [
                    'delete' => 'note2_attachment.ajax.delete',
                ],
                'parameters' => ['id'],
            ],
            'note/attachment' => [
                'fnc' => [
                    'get' => 'note2_attachment.ajax.list',
                    'post' => 'note2_attachment.ajax.add',
                ],
                'parameters' => ['id'],
            ],
        ];
    }
}
