<?php
/**
 * SPT software - homeController
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

namespace App\plugins\user\controllers;

use SPT\Web\user\Controller;

class home extends Controller
{
    public function test()
    {
        $this->set('ctlr_var', 123123);
        $this->app->set('layout', 'home');
    }
 
    public function display()
    {
        $this->app->set('format', 'html');
        $this->app->set('layout', 'home');
    }
}
