<?php
namespace App\plugins\version\registers;

use SPT\Application\IApp;

class Bootstrap
{
    public static function initialize( IApp $app)
    {
        // prepare note
        $container = $app->getContainer();
    }
}