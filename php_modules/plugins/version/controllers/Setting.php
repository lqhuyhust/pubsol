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

use SPT\Web\MVVM\ControllerContainer as Controller;
use SPT\Response;

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
            'version_level',
            'version_level_deep',
        ];

        $try = true;
        foreach ($fields as $key)
        {
            if ($this->request->post->get($key, '', 'int') < 1)
            {
                $this->session->set('flashMsg', 'Invalid setting');
                return Response::redirect( $this->router->url('setting-version'));
            }
            $try = $this->OptionModel->set($key, $this->request->post->get($key, '', 'int'));
            if (!$try) break;
        }

        $msg = $try ? 'Save Successfully.' : 'Save Fail';
        $this->session->set('flashMsg', $msg);
        return Response::redirect( $this->router->url('setting-version'));
    }

}