<?php
namespace App\plugins\milestone\registers;

use SPT\Application\IApp;

class Bootstrap
{
    public static function initialize( IApp $app)
    {
        // prepare milestone
        $container = $app->getContainer();
    }
}