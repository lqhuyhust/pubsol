<?php
/**
 * SPT software - frontend controller
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: a controller for a page
 *
 */

namespace App\plugins\page_contact\controllers;

use SPT\Web\ControllerMVVM;

class front extends ControllerMVVM
{
    public function display()
    {
        $this->app->set('layout', 'demo');
    }
}