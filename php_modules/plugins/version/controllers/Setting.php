<?php
/**
 * SPT software - homeController
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

namespace App\plugins\version\controllers;

use SPT\MVC\JDIContainer\MVController;

class Setting extends Admin 
{
    public function version()
    {
        $this->isLoggedIn();
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.version.setting');
        $this->app->set('page', 'backend');
    }

    public function versionSave()
    {
        $this->isLoggedIn();
        $fields = [
            'version_format_x',
            'version_format_y',
            'version_format_z',
        ];

        $try = true;
        foreach ($fields as $key)
        {
            $value = $this->request->post->get($key, '', 'string');
            if ($value && substr_count($value, 'x') != strlen($value))
            {
                $this->session->set('flashMsg', 'Invalid format, version format only \'x\' character');
                $this->app->redirect( $this->router->url('setting-version'));
            }
            $try = $this->OptionModel->set($key, $this->request->post->get($key, '', 'string'));
            if (!$try) break;
        }

        $msg = $try ? 'Save Done.' : 'Save Fail';
        $this->session->set('flashMsg', $msg);
        $this->app->redirect( $this->router->url('setting-version'));
    }

}