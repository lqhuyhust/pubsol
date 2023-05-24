<?php
namespace App\plugins\user\libraries;

use SPT\Application\IApp;

class Permission
{
    public function __construct( IApp $app)
    {
        $this->app = $app;
        $this->container = $app->getContainer();

        // get access
        $register_access = [];
        $app->plgLoad('permission', 'registerAccess', function($access) use (&$register_access){
            if (is_array($access) && $access)
            {
                $register_access = array_merge($register_access, $access);
            }
        });

        $this->access = $register_access;
    }

    public function getAccess()
    {
        return $this->access;
    }

    public function checkPermission($access = null)
    {
        if (!$access)
        {
            $permission = $this->app->get('permission', []);
            $request = $this->container->get('request');
            $method = $request->header->getRequestMethod();

            if (!$permission || !isset($permission[$method]) || !$permission[$method])
            {
                return true;
            }
            
            $access = $permission[$method];
        }
        
        $user_access = $this->getAccessByUser();
        foreach($access as $item)
        {
            if (in_array($item, $user_access))
            {
                return true;
            }
        }

        return false;
    }

    public function getAccessByUser()
    {
        $UserEntity = $this->container->get('UserEntity');
        $GroupEntity = $this->container->get('GroupEntity');
        $user = $this->container->get('user');
        
        if (!$user)
        {
            return [];
        }

        $groups = $UserEntity->getGroups($user->get('id'));
        $access = [];

        foreach($groups as $group)
        {
            $group_tmp = $GroupEntity->findByPK($group['group_id']);
            if ($group_tmp)
            {
                $access_tmp = $group_tmp['access'] ? json_decode($group_tmp['access'], true) : [];
                $access = array_merge($access, $access_tmp);
            }
        }

        return $access;
    }
}