<?php

namespace App\plugins\note2_html\registers;

use SPT\Application\IApp;

class Notetype
{
    public static function registerType()
    {
        return [
            'html' => [
                'namespace' => 'App\plugins\note2_html\\',
                'title' => 'Html'
            ]
        ];
    }
}