<?php
namespace App\plugins\widget_html\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'widget/html' => [
                'fnc' => [
                    'get' => 'widget_html.ajax.detail',
                    'post' => 'widget_html.ajax.add',
                    'put' => 'widget_html.ajax.update',
                    'delete' => 'widget_html.ajax.delete'
                ],
                'parameters' => ['id'],
            ]
        ];
    }
}