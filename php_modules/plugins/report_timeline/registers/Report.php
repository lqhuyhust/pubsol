<?php
namespace App\plugins\report_timeline\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Report
{
    public static function registerType( IApp $app )
    {
        return [
            'timeline' => [
                'title' => 'Timeline',
                'namespace' => 'App\plugins\report_timeline\\',
                'remove_object' => 'TimelineModel',
            ],
        ];
    }
}