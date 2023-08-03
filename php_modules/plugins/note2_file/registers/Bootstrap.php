<?php
namespace App\plugins\core\registers;

use SPT\Application\IApp;
use SPT\File;

class Bootstrap
{
    public static function initialize( IApp $app)
    {
        $container = $app->getContainer();
        if (!$container->exists('file')) 
        {
            $container->set('file', new File());
        }
    }
}