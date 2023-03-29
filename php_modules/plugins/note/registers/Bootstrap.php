<?php
namespace App\plugins\note\registers;

use SPT\Application\IApp;
use SPT\File;

class Bootstrap
{
    public static function initialize( IApp $app)
    {
        // prepare note
        $container = $app->getContainer();
        if (!$container->exists('file'))
        {
            $container->set('file', new File());
        }
    }
}