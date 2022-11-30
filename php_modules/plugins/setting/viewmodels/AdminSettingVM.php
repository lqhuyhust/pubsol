<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\facts4me\viewmodels;

use SPT\View\VM\JDIContainer\ViewModel;
use SPT\View\Gui\Form;

class AdminSettingVM extends ViewModel
{
    protected $alias = 'AdminSettingVM';
    protected $layouts = [
        'layouts.backend.setting' => [
            'form'
        ]
    ];

    public function form()
    {
        
        $fields = $this->getFormFields();
        
        $data = [];
        foreach ($fields as $key => $value) {
            if ($key != 'token') {
                $data[$key] =  $this->OptionModel->get($key, '');
            }
        }
        $form = new Form($this->getFormFields(), $data);
        $fileds = $this->getFormFields();
        $title_page = 'Setting';
        $this->view->set('fileds', $fileds, true);
        $this->view->set('form', $form, true);
        $this->view->set('title_page', $title_page, true);
        $this->view->set('data', $data, true);
        $this->view->set('url', $this->router->url(), true);
        $this->view->set('link_form', $this->router->url('admin/setting'));
    }

    public function getFormFields()
    {
        $email_tmps = $this->EmailTmpEntity->list(0, 0);
        $options = [
            [
                'text' => 'Select email template',
                'value' => '',
            ],
        ];
        foreach ($email_tmps as $item)
        {
            $options[] = [
                'text' => $item['e_name'],
                'value' => $item['id'],
            ];
        }
        $fields = [
            'email_host' => [
                'text',
                'showLabel' => false,
                'label' => 'Email Host:',
                'formClass' => 'form-control',
            ],
            'email_username' => [
                'email',
                'showLabel' => false,
                'label' => 'Email:',
                'formClass' => 'form-control',
            ],
            'email_password' => [
                'password',
                'showLabel' => false,
                'label' => 'Password Email:',
                'formClass' => 'form-control',
            ],
           
        ];

        return $fields;
    }
}
