<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic viewmodel
 * 
 */
namespace App\plugins\core\viewmodels; 

use SPT\View\VM\JDIContainer\ViewModel; 

class WidgetsVM extends ViewModel
{
    protected $alias = 'WidgetsVM';
    protected $layouts = ['widgets.backend.sidebar'];

    public function sidebar()
    {
        $this->set('path_current', $this->router->get('actualPath')); 
        $this->set('logout_link', $this->router->url('admin/logout')); 
        $this->set('link_admin', $this->router->url('admin/')); 
        $this->set('url', $this->router->url(), true);
    }
}
