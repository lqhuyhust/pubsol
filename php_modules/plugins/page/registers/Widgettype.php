<?php
namespace App\plugins\page\registers;

class Widgettype
{
    public static function registerType()
    {
        return [
            'html' => [
                'path' => 'html',
                'name' => 'Html',
                'link' => 'widget/html',
            ],
            'text' => [
                'path' => 'text',
                'name' => 'Text',
                'link' => 'widget/text',
            ],
        ];
    }
}