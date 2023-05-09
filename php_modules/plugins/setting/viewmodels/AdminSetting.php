<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\setting\viewmodels;

use SPT\Web\MVVM\ViewModel;
use SPT\View\Gui\Form;

class AdminSetting extends ViewModel
{
    public static function register()
    {
        return [
            'layouts.backend.setting.system',
            'layouts.backend.setting.smtp',
        ];
    }

    public function system()
    {
        $OptionModel = $this->container->get('OptionModel');
        $router = $this->container->get('router');

        $fields = $this->getFormFields();
        
        $data = [];
        foreach ($fields as $key => $value) {
            if ($key != 'token') {
                $data[$key] =  $OptionModel->get($key, '');
            }
        }
        $form = new Form($this->getFormFields(), $data);

        $title_page = 'Setting System';

        return [
            'fields' => $fields,
            'form' => $form,
            'title_page' => $title_page,
            'data' => $data,
            'url' => $router->url(),
            'link_form' => $router->url('setting-system'),
            'link_mail_test' => $router->url('setting/mail-test'),
        ];
    }

    public function getFormFields()
    {
        $fields = [
            'admin_mail' => [
                'text',
                'label' => 'Admin Mail:',
                'formClass' => 'form-control',
            ],
            'token' => ['hidden',
                'default' => $this->container->get('token')->getToken(),
            ],
        ];
       
        return $fields;
    }

    public function smtp()
    {
        $OptionModel = $this->container->get('OptionModel');
        $router = $this->container->get('router');

        $fields = $this->getFormFieldsSMTP();
        
        $data = [];
        foreach ($fields as $key => $value) {
            if ($key != 'token') {
                $data[$key] =  $OptionModel->get($key, '');
            }
        }
        $form = new Form($fields, $data);

        $title_page = 'Setting SMTP';
        return [
            'fields' => $fields,
            'form' => $form,
            'title_page' => $title_page,
            'data' => $data,
            'url' => $router->url(),
            'link_form' => $router->url('setting-smtp'),
            'link_mail_test' => $router->url('setting/mail-test'),
        ];
    }

    public function getFormFieldsSMTP()
    {
        $fields = [
            'email_host' => [
                'text',
                'label' => 'Email Host:',
                'formClass' => 'form-control',
            ],
            'email_port' => [
                'text',
                'label' => 'Email Port:',
                'formClass' => 'form-control',
            ],
            'email_username' => [
                'email',
                'label' => 'Email:',
                'formClass' => 'form-control',
            ],
            'email_password' => [
                'password',
                'label' => 'Password Email:',
                'formClass' => 'form-control',
            ],
            'email_from_addr' => [
                'email',
                'label' => 'From Email:',
                'formClass' => 'form-control',
            ],
            'email_from_name' => [
                'text',
                'label' => 'From Name:',
                'formClass' => 'form-control',
            ],
            'token' => ['hidden',
                'default' => $this->container->get('token')->getToken(),
            ],
        ];
       
        return $fields;
    }
}
