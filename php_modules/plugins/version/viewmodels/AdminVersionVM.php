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
use SPT\View\VM\JDIContainer\ViewModel;
use SPT\Util;

class AdminVersionVM extends ViewModel
{
    protected $alias = 'AdminVersionVM';
    protected $layouts = [
        'layouts.backend.version' => [
            'form'
        ],
        'layouts.backend.version' => [
            'setting'
        ]
    ];

    public function form()
    {
        $form = new Form($this->getFormFields(), []);

        $this->set('form', $form, true);
        $this->set('url', $this->router->url(), true);
        $this->set('link_list', $this->router->url('versions'));
        $this->set('link_form', $this->router->url('versions'));
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
                'default' => $this->app->getToken(),
            ],
        ];

        if($this->view->id)
        {
            $fields['modified_at'] = ['readonly'];
            $fields['modified_by'] = ['readonly'];
            $fields['created_at'] = ['readonly'];
            $fields['created_by'] = ['readonly'];
        }
        else
        {
            $fields['modified_at'] = ['hidden'];
            $fields['modified_by'] = ['hidden'];
            $fields['created_at'] = ['hidden'];
            $fields['created_by'] = ['hidden'];
        }

        return $fields;
    }

    public function setting()
    {
        $fields = $this->getFormFieldsSetting();
        
        $data = [];
        foreach ($fields as $key => $value) {
            if ($key != 'token') {
                $data[$key] =  $this->OptionModel->get($key, '');
            }
        }
        $form = new Form($this->getFormFieldsSetting(), $data);

        $title_page = 'Setting Version';
        $this->view->set('fields', $fields, true);
        $this->view->set('form', $form, true);
        $this->view->set('title_page', $title_page, true);
        $this->view->set('data', $data, true);
        $this->view->set('url', $this->router->url(), true);
        $this->view->set('link_form', $this->router->url('setting-version'));
        $this->view->set('link_mail_test', $this->router->url('setting/mail-test'));
    }

    public function getFormFieldsSetting()
    {
        $fields = [
            'version_format_x' => [
                'text',
                'showLabel' => false,
                'placeholder' => 'xx',
                'formClass' => 'form-control',
                'required' => 'required'
            ],
            'version_format_y' => [
                'text',
                'showLabel' => false,
                'placeholder' => 'xx',
                'formClass' => 'form-control',
                'required' => 'required'
            ],
            'version_format_z' => [
                'text',
                'showLabel' => false,
                'placeholder' => 'xx',
                'formClass' => 'form-control',
            ],
            'token' => ['hidden',
                'default' => $this->app->getToken(),
            ],
        ];

        if($this->view->id)
        {
            $fields['modified_at'] = ['readonly'];
            $fields['modified_by'] = ['readonly'];
            $fields['created_at'] = ['readonly'];
            $fields['created_by'] = ['readonly'];
        }
        else
        {
            $fields['modified_at'] = ['hidden'];
            $fields['modified_by'] = ['hidden'];
            $fields['created_at'] = ['hidden'];
            $fields['created_by'] = ['hidden'];
        }

        return $fields;
    }
}
