<?php
namespace App\plugins\core\registers;

use SPT\Application\IApp;

class Middleware
{
    public static function AfterRouting( IApp $app )
    {
        $container = $app->getContainer();
        $config = $container->get('config');
        $request = $container->get('request');

        if(!$config->exists('defaultTheme'))
        {
            throw new \Exception('Configuration did not set up theme');
        }
        
        $theme = $request->get('theme', $config->defaultTheme);

        $app->set('theme', $theme);
    }
}