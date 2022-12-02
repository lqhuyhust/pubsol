<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\core\viewmodels; 

use SPT\View\VM\JDIContainer\ViewModel; 

class SideBarVM extends ViewModel
{
    protected $alias = 'SideBarVM';
    protected $layouts = [
        'widgets.backend.sidebar'
    ];

    public function sidebar()
    {
        $menu = [];
        foreach ($this->plugin as $plg)
        {
            if (method_exists($plg, 'registerMenu'))
            {
                $menu_tmp = $plg->registerMenu();
                if (is_array($menu_tmp))
                {
                    $menu = array_merge($menu, $menu_tmp);
                }
            }
        }
        // $menu = array_merge($menu, [
        //     [['users', 'user',], 'users', 'Users', '<i class="fa-solid fa-user"></i>', ''],
        //     [['milestones', 'milestone',], 'milestones', 'Milestones', '<i class="fa-solid fa-business-time"></i>', ''],
        //     [['setting', 'setting',], 'setting', 'Setting', '<i class="fa-solid fa-gear"></i>', ''],
        // ]);
        // $menu = array_merge($menu, 
        //     [
        //         [['logout'], 'logout', 'Logout', '<i class="fa-solid fa-right-from-bracket"></i>', '']
        //     ],
        // );

        $this->set('path_current', $this->router->get('actualPath')); 
        $this->set('logout_link', $this->router->url('admin/logout')); 
        $this->set('link_admin', $this->router->url('admin/')); 
        $this->set('url', $this->router->url(), true);
        $this->set('menu', $menu);
        $this->set('u_type', $this->user->get('u_type'), true);
    }
}