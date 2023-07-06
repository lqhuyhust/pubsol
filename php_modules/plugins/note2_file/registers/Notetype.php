<?php

namespace App\plugins\note2_file\registers;

use SPT\Application\IApp;

class Notetype
{
    public static function registerType()
    {
        return [
            'file' => [
                'namespace' => 'App\plugins\note2_file\\',
                'title' => 'File Upload'
            ]
        ];
    }
}
