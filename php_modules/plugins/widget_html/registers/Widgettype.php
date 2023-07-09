<?php
namespace App\plugins\widget_html\registers;

class Widgettype
{
    public static function registerType()
    {
        return [
            'html' => [
                'layout' => 'page::html',
                'name' => 'Html',
                'link' => 'widget/html',
            ]
        ];
    }
}