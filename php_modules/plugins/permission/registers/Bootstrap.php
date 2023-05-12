<?php
namespace App\plugins\permission\registers;

use SPT\Application\IApp;

class Bootstrap
{
    public static function initialize( IApp $app)
    {
        // create permission
        $container = $app->getContainer();
        $container->set('permission', new Permission($app));
    }
}