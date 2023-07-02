<?php namespace App\plugins\test\controllers;

use SPT\Web\ControllerMVVM;
use SPT\Response;

class demo extends ControllerMVVM 
{
    public function test()
    {  
        echo 'itttt'; die;
    }
}