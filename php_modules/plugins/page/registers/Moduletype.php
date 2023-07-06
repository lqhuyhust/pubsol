<?php
namespace App\plugins\page\registers;

class Moduletype
{
    public static function registerType()
    {
        return [
            'html' => [
                'path' => 'html',
                'name' => 'Html',
                'link' => 'module/html',
            ],
            'text' => [
                'path' => 'text',
                'name' => 'Text',
                'link' => 'module/text',
            ],
        ];
    }
}