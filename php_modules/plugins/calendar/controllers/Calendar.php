<?php
/**
 * SPT software - homeController
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 *
 */

namespace App\plugins\calendar\controllers;

use SPT\Web\ControllerMVVM;

class Calendar extends ControllerMVVM 
{
    public function diagram()
    {
        
        $this->app->set('layout', 'backend.calendar.diagram');
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
    }
}