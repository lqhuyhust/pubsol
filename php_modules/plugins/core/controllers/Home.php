<?php
/**
 * SPT software - homeController
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

namespace App\plugins\core\controllers;

use SPT\Web\MVC\Controller;

class home extends Controller
{
    public function display()
    {
        $this->app->set('format', 'html');
        $this->app->set('layout', 'home');
    }
}
