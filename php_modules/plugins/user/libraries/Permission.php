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
        $this->access = [];
        $this->config = [];
        foreach(new \DirectoryIterator(SPT_PLUGIN_PATH) as $item) 
        {
            if (!$item->isDot() && $item->isDir()) 
            { 
                $plgRegister = $this->app->getNamespace(). '\\plugins\\'. $item->getBasename(). '\\registers\\Permission';
                if(class_exists($plgRegister) && method_exists($plgRegister, 'registerAccess'))
                {
                    $result = $plgRegister::registerAccess();
                    
                    if (is_array($result))
                    {
                        $this->access = array_merge($this->access, $result);
                    }
                }

                if(class_exists($plgRegister) && method_exists($plgRegister, 'registerPermission'))
                {
                    $result = $plgRegister::registerPermission();
                    
                    if (is_array($result))
                    {
                        $this->config[$item->getBasename()] = $result;
                    }
                }
            }
        }
    }

    public function getAccess()
    {
        return $this->access;
    }

    public function checkPermission($access = null)
    {
        if (!$access)
        {
            $router = $this->container->get('router');
            $request = $this->container->get('request');
            $actualPath = trim($router->get('actualPath'), '/');
            $method = $request->header->getRequestMethod();
            
            $siteNote = $router->get('sitenode');
            $path = $siteNote ? trim($siteNote, '/') : $actualPath;
            
            $plugin = $this->app->get('currentPlugin');
            $config_plugin = isset($this->config[$plugin]) ? $this->config[$plugin] : [];
            $access = isset($config_plugin[$path]) ? $config_plugin[$path] : [];
            $access = isset($access[$method]) ? $access[$method] : [];
        }
        
        if ($access)
        {
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

        return true;
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