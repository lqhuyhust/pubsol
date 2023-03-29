<?php
/**
 * SPT software - homeController
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

namespace App\plugins\note\controllers;

use SPT\Web\MVVM\ControllerContainer as Controller;
use SPT\Response;

class Admin extends Controller 
{
    public function isLoggedIn()
    {
        if( !$this->user->get('id') )
        {
            return Response::redirect(
                $this->router->url(
                    'login'
                )
            );
        }
    }

}