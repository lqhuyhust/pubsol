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
            // 'email_confirmation' => [
            //     'email',
            //     'showLabel' => false,
            //     'label' => 'Facts4Me Confirmation Email:',
            //     'formClass' => 'form-control',
            // ],
            // 'email_receive' => [
            //     'email',
            //     'showLabel' => false,
            //     'label' => 'Email Contact Support:',
            //     'formClass' => 'form-control',
            // ],
            // 'stripe_publish_key' => [
            //     'text',
            //     'showLabel' => false,
            //     'label' => 'Stripe Publish Key:',
            //     'formClass' => 'form-control',
            // ],
            // 'stripe_secret_key' => [
            //     'password',
            //     'showLabel' => false,
            //     'label' => 'Stripe Secret Key:',
            //     'formClass' => 'form-control',
            // ],
            // 'tmp_basic_school_renew' => [
            //     'option',
            //     'label' => 'Select template email for basic school renew',
            //     'options' => $options,
            //     'showLabel' => false,
            //     'formClass' => 'form-select',
            // ],
            // 'tmp_basic_school' => [
            //     'option',
            //     'label' => 'Select template email for subcription basic school',
            //     'options' => $options,
            //     'showLabel' => false,
            //     'formClass' => 'form-select',
            // ],
            // 'tmp_extended_school_renew' => [
            //     'option',
            //     'label' => 'Select template email for extended school renew',
            //     'options' => $options,
            //     'showLabel' => false,
            //     'formClass' => 'form-select',
            // ],
            // 'tmp_extended_school' => [
            //     'option',
            //     'label' => 'Select template email for extended school',
            //     'options' => $options,
            //     'showLabel' => false,
            //     'formClass' => 'form-select',
            // ],
            // 'tmp_gift_home_giver' => [
            //     'option',
            //     'label' => 'Select template email for gift home giver',
            //     'options' => $options,
            //     'showLabel' => false,
            //     'formClass' => 'form-select',
            // ],
            // 'tmp_gift_home' => [
            //     'option',
            //     'label' => 'Select template email for gift home',
            //     'options' => $options,
            //     'showLabel' => false,
            //     'formClass' => 'form-select',
            // ],
            // 'tmp_gift_teacher_giver' => [
            //     'option',
            //     'label' => 'Select template email for gift teacher giver',
            //     'options' => $options,
            //     'showLabel' => false,
            //     'formClass' => 'form-select',
            // ],
            // 'tmp_gift_teacher' => [
            //     'option',
            //     'label' => 'Select template email for gift teacher',
            //     'options' => $options,
            //     'showLabel' => false,
            //     'formClass' => 'form-select',
            // ],
            // 'tmp_home_renew' => [
            //     'option',
            //     'label' => 'Select template email for home renew',
            //     'options' => $options,
            //     'showLabel' => false,
            //     'formClass' => 'form-select',
            // ],
            // 'tmp_home' => [
            //     'option',
            //     'label' => 'Select template email for home subscription',
            //     'options' => $options,
            //     'showLabel' => false,
            //     'formClass' => 'form-select',
            // ],
            // 'tmp_teacher_renew' => [
            //     'option',
            //     'label' => 'Select template email for teacher renew',
            //     'options' => $options,
            //     'showLabel' => false,
            //     'formClass' => 'form-select',
            // ],
            // 'tmp_teacher' => [
            //     'option',
            //     'label' => 'Select template email for teacher subscription',
            //     'options' => $options,
            //     'showLabel' => false,
            //     'formClass' => 'form-select',
            // ],
            // 'tmp_contact' => [
            //     'option',
            //     'label' => 'Select template email for contact:',
            //     'options' => $options,
            //     'showLabel' => false,
            //     'formClass' => 'form-select',
            // ],
            // 'tmp_tell_friend' => [
            //     'option',
            //     'label' => 'Select template email for tell a friend:',
            //     'options' => $options,
            //     'showLabel' => false,
            //     'formClass' => 'form-select',
            // ],
            // 'token' => [
            //     'hidden',
            //     'default' => $this->app->getToken(),
            // ],
        ];

        return $fields;
    }
}
