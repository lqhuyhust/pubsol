<?php
namespace App\plugins\page_contact\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'contact/submit' => [
                'fnc' => [
                    'post' => 'page_contact.front.submit',
                ],
            ],
        ];
    }
}