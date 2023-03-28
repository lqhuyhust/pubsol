<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\menu\viewmodels;  

use SPT\Web\MVVM\ViewModel;

class SideBarVM extends ViewModel
{
    public static function register()
    {
        return [
            'widgets.backend.sidebar'
        ];
    }

    public function sidebar()
    {
        $menu = [];
        $this->app->loadPlugin('menu', 'register');
        $menu = $this->menu;

        // $this->set('path_current', $this->router->get('actualPath')); 
        // $this->set('logout_link', $this->router->url('logout')); 
        // $this->set('link_admin', $this->router->url('')); 
        // $this->set('menu', $menu);
        // $this->set('u_type', $this->user->get('u_type'), true);
    }
}
