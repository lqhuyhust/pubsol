<?php

namespace App\plugins\user\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'user_manager', 'user_read', 'user_create', 'user_update', 'user_delete', 'user_profile',
            'usergroup_manager', 'usergroup_read', 'usergroup_create', 'usergroup_update', 'usergroup_delete'
        ];
    }
    
    public static function CheckSession(IApp $app)
    {
        $user = $app->getContainer()->get('user');
        $permission = $app->getContainer()->get('PermissionModel');

        if( is_object($user) && $user->get('id') )
        {
            $allow = $permission->checkPermission();
            if ($allow)
            {
                return true;
            }

            $app->redirect(
                $app->getRouter()->url('')
            );
        } 

        $app->redirect(
            $app->getRouter()->url('login')
        );
    }
}
