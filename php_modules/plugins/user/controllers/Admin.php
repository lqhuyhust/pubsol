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

use SPT\Web\MVVM\ControllerContainer as Controller;
use SPT\Application\IApp;

class Admin extends Controller 
{
    public function isLoggedIn()
    {
        if( !$this->container->get('user')->get('id') )
        {
            return $this->container->get('response')->redirect(
                $this->app->url(
                    'login'
                )
            );
        }
    }

}