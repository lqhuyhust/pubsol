<?php

namespace App\plugins\milestone\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'milestone_manager', 'milestone_view', 'milestone_update', 'milestone_create', 'milestone_delete',
            'request_manager', 'request_view', 'request_update', 'request_create', 'request_delete',
        ];
    }

    public static function registerPermission()
    {
        return [
            'milestones'=>[
                'get' => ['milestone_manager', 'milestone_view'],
                'post' => ['milestone_manager', 'milestone_view'],
                'put' => ['milestone_manager', 'milestone_update'],
                'delete' => ['milestone_manager', 'milestone_delete']
            ],
            'requests' => [
                'get' => ['request_manager', 'request_view'],
                'post' => ['request_manager', 'request_view'],
                'put' => ['request_manager', 'request_update'],
                'delete' => ['request_manager', 'request_delete']
            ],
            'request' => [
                'get' => ['request_manager', 'request_view'],
                'post' => ['request_manager', 'request_create'],
                'put' => ['request_manager', 'request_update'],
                'delete' => ['request_manager', 'request_delete']
            ],
            'tasks' => [
                'post' => ['request_manager', 'request_update'],
                'put' => ['request_manager', 'request_update'],
                'delete' => ['request_manager', 'request_update']
            ],
            'task' => [
                'get' => ['request_manager', 'request_update'],
                'post' => ['request_manager', 'request_update'],
                'put' => ['request_manager', 'request_update'],
                'delete' => ['request_manager', 'request_update']
            ],
            'relate-notes' => [
                'post' => ['request_manager', 'request_update'],
                'put' => ['request_manager', 'request_update'],
                'delete' => ['request_manager', 'request_update']
            ],
            'get-notes' => [
                'post' => ['request_manager', 'request_update'],
            ],
            'detail-request' => [
                'get' => ['request_manager', 'request_view'],
            ],
            'document/version' => [
                'get' => ['request_manager', 'request_update'],
                'post' => ['request_manager', 'request_update'],
                'delete' => ['request_manager', 'request_update']
            ],
            'document' => [
                'post' => ['request_manager', 'request_update'],
            ],
            'get-history' => [
                'post' => ['request_manager', 'request_update'],
            ],
            'get-comment' => [
                'post' => ['request_manager', 'request_update'],
            ],
            'discussion' => [
                'post' => ['request_manager', 'request_update'],
            ],
            'relate-note' => [
                'get' => ['request_manager', 'request_update'],
                'post' => ['request_manager', 'request_update'],
                'put' => ['request_manager', 'request_update'],
                'delete' => ['request_manager', 'request_update']
            ],
            'milestone' => [
                'get' => ['milestone_manager', 'milestone_update'],
                'post' => ['milestone_manager', 'milestone_update'],
                'put' => ['milestone_manager', 'milestone_update'],
                'delete' => ['milestone_manager', 'milestone_update']
            ],
            'request-versions' => [
                'post' => ['milestone_manager', 'milestone_update'],
            ],
            'request-version' => [
                'post' => ['milestone_manager', 'milestone_update'],
                'put' => ['milestone_manager', 'milestone_update'],
                'delete' => ['milestone_manager', 'milestone_update']
            ],
        ];
    }
}
