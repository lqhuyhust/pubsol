<?php
namespace App\plugins\widget_html\registers;

class Widgettype
{
    public static function registerType()
    {
        return [
            'html' => [
                'layout' => 'widget_html::html',
                'name' => 'Html',
                'link' => 'widget/html',
            ]
        ];
    }
}