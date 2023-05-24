<?php


namespace App\plugins\calendar\controllers;

use SPT\Web\MVVM\ControllerContainer as Controller;

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