<?php
namespace App\plugins\page\registers;

use App\plugins\page\libraries\PageDispatch;
use SPT\Application\IApp; 
use SPT\File;

class Dispatcher
{
    public static function dispatch(IApp $app)
    {
        $pageDispatcher = new PageDispatch($app->getContainer());
        $pageDispatcher->execute();
    }
}