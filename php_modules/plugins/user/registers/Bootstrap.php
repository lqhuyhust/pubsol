<?php
namespace App\plugins\user\registers;

use SPT\Application\IApp;
use App\plugins\user\libraries\Permission;

class Bootstrap
{
    public static function initialize( IApp $app)
    {
        // TODO: move user setting here
        $container = $app->getContainer();
        $container->set('permission', new Permission($app));
    }
}