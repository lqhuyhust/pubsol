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

use SPT\Web\MVVM\Controller;
use SPT\Application\IApp;
use SPT\Response;

class Admin extends Controller 
{
    public function __construct(IApp $app)
    {
        parent::__construct($app);
        $this->container = $app->getContainer();
        $this->user = $this->container->get('user');
        $this->response = $this->container->get('response');
    }

    public function isLoggedIn()
    {
        if( !$this->user->get('id') )
        {
            return $this->response->redirect(
                $this->app->url(
                    'login'
                )
            );
        }
    }

}