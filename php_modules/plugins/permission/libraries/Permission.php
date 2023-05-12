<?php
namespace App\plugins\permission\libraries;

use SPT\Application\IApp;

class Permission
{
    public function __construct( IApp $app)
    {
        $this->app = $app;
        $this->container = $app->getContainer();
    }

    public function getAccess()
    {
        return [];
    }

    public function checkPermission($access = null)
    {
        
    }
}