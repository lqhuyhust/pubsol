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

use SPT\View\VM\JDIContainer\ViewModel;
use SPT\View\Gui\Form;

class AdminSettingVM extends ViewModel
{
    protected $alias = 'AdminSettingVM';
    protected $layouts = [
        'layouts.backend.setting' => [
            'system',
            'smtp',
        ]
    ];

    public function system()
    {
        
        $fields = $this->getFormFields();
        
        $data = [];
        foreach ($fields as $key => $value) {
            if ($key != 'token') {
                $data[$key] =  $this->OptionModel->get($key, '');
            }
        }
        $form = new Form($this->getFormFields(), $data);

        $title_page = 'Setting System';
        $this->view->set('fields', $fields, true);
        $this->view->set('form', $form, true);
        $this->view->set('title_page', $title_page, true);
        $this->view->set('data', $data, true);
        $this->view->set('url', $this->router->url(), true);
        $this->view->set('link_form', $this->router->url('setting-system'));
        $this->view->set('link_mail_test', $this->router->url('setting/mail-test'));
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
                'default' => $this->app->getToken(),
            ],
        ];
       
        return $fields;
    }

    public function smtp()
    {
        
        $fields = $this->getFormFieldsSMTP();
        
        $data = [];
        foreach ($fields as $key => $value) {
            if ($key != 'token') {
                $data[$key] =  $this->OptionModel->get($key, '');
            }
        }
        $form = new Form($fields, $data);

        $title_page = 'Setting SMTP';
        $this->view->set('fields', $fields, true);
        $this->view->set('form', $form, true);
        $this->view->set('title_page', $title_page, true);
        $this->view->set('data', $data, true);
        $this->view->set('url', $this->router->url(), true);
        $this->view->set('link_form', $this->router->url('setting-smtp'));
        $this->view->set('link_mail_test', $this->router->url('setting/mail-test'));
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
                'default' => $this->app->getToken(),
            ],
        ];
       
        return $fields;
    }
}
