<?php
namespace App\plugins\page_html\registers;

class Pagetype
{
    public static function registerType()
    {
        return [
            'html' => [
                'fnc' => 'page_html.front.display',
                'name' => 'Html page',
                'namespace' => 'App\plugins\page_html\controllers\\',
            ],
        ];
    }
}