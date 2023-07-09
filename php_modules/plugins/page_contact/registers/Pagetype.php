<?php
namespace App\plugins\page_contact\registers;

class Pagetype
{
    public static function registerType()
    {
        return [
            'contact' => [
                'fnc' => 'page_contact.front.display',
                'name' => 'Contact page',
                'namespace' => 'App\plugins\page_contact\controllers\\',
            ],
        ];
    }
}