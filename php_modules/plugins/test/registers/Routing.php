<?php
namespace App\plugins\test\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        // TODO: should register home follow configuration and add it here
        // NOW: we set default home here
        return [
            'test' => 'test.demo.test',
        ];
    }
}