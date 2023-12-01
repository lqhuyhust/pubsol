<?php

namespace App\plugins\member\registers;

use SPT\Application\IApp;

class Routing 
{
    public static function registerEndpoints()
    {
        return [
            'members' => [
                'fnc' => [
                    'get' => 'member.member.list',
                    'post' => 'member.member.list',
                    'delete' => 'member.member.delete'
                ],
                'permission' => [
                    'get' => ['member_manager', 'member_read'],
                    'post' => ['member_manager', 'member_read'],
                    'delete' =>  ['member_manager', 'member_delete']
                ],
            ],
            'member' => [
                'fnc' => [
                    'get' => 'member.member.detail',
                    'post' => 'member.member.add',
                    'put' => 'member.member.update',
                ],
                'parameters' => ['id'],
                'permission' => [
                    'get' =>  ['member_manager', 'member_read'],
                    'post' =>  ['member_manager', 'member_create'],
                    'put' =>  ['member_manager', 'member_update'],
                ],
            ],
        ];
    }
}