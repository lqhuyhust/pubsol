<?php
namespace App\plugins\permission\registers;

use SPT\Application\IApp;
use App\plugins\permission\libraries\Permission;

class Bootstrap
{
    public static function initialize( IApp $app)
    {
        // create permission
        $container = $app->getContainer();
        $container->set('permission', new Permission($app));
    }
}