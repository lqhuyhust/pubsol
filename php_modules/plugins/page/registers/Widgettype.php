<?php
namespace App\plugins\page\registers;

class Widgettype
{
    public static function registerType()
    {
        return [
            'html' => [
                'layout' => 'page::html',
                'name' => 'Html',
                'link' => 'widget/html',
            ],
            'text' => [
                'layout' => 'page::text',
                'name' => 'Text',
                'link' => 'widget/text',
            ],
        ];
    }
}