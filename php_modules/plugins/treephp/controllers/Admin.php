<?php


namespace App\plugins\treephp\controllers;

use SPT\Web\MVVM\ControllerContainer as Controller;
use SPT\Response;

class Admin extends Controller 
{
    public function isLoggedIn()
    {
        if( !$this->user->get('id') )
        {
            return $this->app->redirect(
                $this->router->url(
                    'login'
                )
            );
        }
    }

}