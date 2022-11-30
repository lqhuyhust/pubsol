<?php
/**
 * SPT software - homeController
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

namespace App\plugins\setting\controllers;

use App\plugins\setting\controllers\Admin;

class Setting extends Admin
{
    public function form()
    {
        // $this->isAdmin();
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.setting.form');
        $this->app->set('page', 'backend');
    }

    public function save()
    {
        // $this->isAdmin();
        // $this->validateToken();

        $fields = $this->AdminSettingVM->getFormFields();
        $try = true;
        foreach ($fields as $key => $value)
        {
            $try = $this->OptionModel->set($key, $this->request->post->get($key, '', 'string'));
            if (!$try) break;
        }

        $msg = $try ? 'Save Done.' : 'Save Fail';
        $this->session->set('flashMsg', $msg);
        $this->app->redirect( $this->router->url('admin/setting'));
    }
}