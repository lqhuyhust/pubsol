<?php
namespace App\plugins\page\registers;

class Contenttype
{
    public static function registerType()
    {
        return [
            'basic' => [
                'fnc' => 'page.page.basic',
                'name' => 'Basic',
                'namespace' => 'App\plugins\page\controllers\\',
            ],
        ];
    }
}