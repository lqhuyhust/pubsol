<?php
namespace App\plugins\permission\libraries;

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
            $router = $this->container->getRouter();
            $plugin = $this->app->get('currentPlugin');
            $config_plugin = isset($config[$plugin]) ? $config[$plugin] : [];
            
        }

        
    }
}