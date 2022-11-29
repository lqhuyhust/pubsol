<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic viewmodel
 * 
 */
namespace App\plugins\setting\viewmodels; 

use SPT\View\VM\JDIContainer\ViewModel; 

class SettingVM extends ViewModel
{
    protected $alias = '';
    protected $layouts = [
        'layouts.backend' => [
            'setting',
        ]
    ];

    public function stripe()
    {
        $fields = $this->getFormFields();
        $data = [];
        foreach($fields as $key => $value)
        {
            $data[$key] =  $this->OptionModel->get('stripe_publish_key', '');
        }
        $form = new Form($this->getFormFields(), $data);

        $this->set('form', $form, true);
        $this->set('url', $this->router->url(), true);
    }

    public function getFormFields()
    {
        $fields = [
            'id' => ['hidden'],
            'site_title' => [
                'text',
                'label' => 'Site Title',
                'formClass' => 'form-control',
            ],
            'email_host' => [
                'text',
                'label' => 'Site Title',
                'formClass' => 'form-control',
            ],
            'email_username' => [
                'text',
                'label' => 'Site Title',
                'formClass' => 'form-control',
            ],
            'email_password' => [
                'text',
                'label' => 'Site Title',
                'formClass' => 'form-control',
            ],
            'stripe_publish_key' => [
                'text',
                'label' => 'Stripe Publish Key',
                'formClass' => 'form-control',
            ],
            'stripe_secret_key' => [
                'text',
                'label' => 'Stripe Secret Key',
                'formClass' => 'form-control',
            ],
            'token' => ['hidden',
                'default' => $this->app->getToken(),
            ],
        ];

        return $fields;
    }
}
