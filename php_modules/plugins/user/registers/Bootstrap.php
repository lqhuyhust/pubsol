<?php
namespace App\plugins\user\registers;

use SPT\Application\IApp;

class Bootstrap
{
    public static function initialize( IApp $app)
    {
        // prepare User
        $container = $app->getContainer();
    }
}