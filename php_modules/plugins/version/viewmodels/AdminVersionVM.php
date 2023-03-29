<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic viewmodel
 * 
 */
namespace App\plugins\version\viewmodels; 

use SPT\View\Gui\Form;
use SPT\View\Gui\Listing;
use SPT\Web\MVVM\ViewModel;

class AdminVersionVM extends ViewModel
{
    protected $alias = 'AdminVersionVM';
    
    public static function register()
    {
        return [
            'layouts.backend.version.form',
            'layouts.backend.version.setting',
        ];
    }

    public function form()
    {
        $form = new Form($this->getFormFields(), []);
        $router = $this->container->get('router');
        return [
            'form' => $form,
            'url' => $router->url(),
            'link_list' => $router->url('versions'),
            'link_form' => $router->url('versions'),
        ];
    }

    public function getFormFields()
    {
        $fields = [
            'id' => ['hidden'],
            'name' => [
                'text',
                'placeholder' => 'New Version',
                'showLabel' => false,
                'formClass' => 'form-control h-50-px fw-bold rounded-0 fs-3',
                'required' => 'required'
            ],
            'release_date' => ['date',
                'showLabel' => false,
                'formClass' => 'form-control rounded-0 border border-1 py-1 fs-4-5',
            ],
            'description' => ['textarea',
                'placeholder' => 'Enter Description',
                'showLabel' => false,
                'formClass' => 'form-control rounded-0 border border-1 py-1 fs-4-5',
            ],
            'token' => ['hidden',
                'default' => $this->container->get('token')->getToken(),
            ],
        ];

        return $fields;
    }

    public function setting()
    {
        $OptionModel = $this->container->get('OptionModel');
        $router = $this->container->get('router');

        $fields = $this->getFormFieldsSetting();
        $data = [];
        foreach ($fields as $key => $value) {
            if ($key != 'token') {
                $data[$key] =  $OptionModel->get($key, '1');
            }
        }
        $form = new Form($this->getFormFieldsSetting(), $data);

        $title_page = 'Version Setting';
        return [
            'fields' => $fields,
            'form' => $form,
            'title_page' => $title_page,
            'data' => $data,
            'url' => $router->url(),
            'link_form' => $router->url('setting-version'),
            'link_mail_test' => $router->url('setting/mail-test'),
        ];
    }

    public function getFormFieldsSetting()
    {
        $fields = [
            'version_level' => [
                'number',
                'showLabel' => false,
                'placeholder' => '',
                'defaultValue' => 1,
                'formClass' => 'form-control',
                'required' => 'required'
            ],
            'version_level_deep' => [
                'number',
                'showLabel' => false,
                'placeholder' => '',
                'defaultValue' => 2,
                'formClass' => 'form-control',
                'required' => 'required'
            ],
            'token' => ['hidden',
                'default' => $this->container->get('token')->getToken(),
            ],
        ];

        return $fields;
    }
}
