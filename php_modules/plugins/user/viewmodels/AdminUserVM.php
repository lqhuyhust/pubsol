<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic viewmodel
 * 
 */
namespace App\plugins\user\viewmodels; 

use SPT\View\Gui\Form;
use SPT\View\Gui\Listing;
use SPT\View\VM\JDIContainer\ViewModel;
use SPT\Util;

class AdminUserVM extends ViewModel
{
    protected $alias = 'AdminUserVM';
    protected $layouts = [
        'layouts.backend.user' => [
            'login',
            'form'
        ]
    ];

    public function login()
    {
        $this->view->set('url', $this->router->url(), true);
        $this->view->set('link_login', $this->router->url('admin/login'), true);
    }

    public function form()
    {
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];
        $this->set('id', $id, true);

        $data = $id ? $this->UserEntity->findByPK($id) : [];
        $form = new Form($this->getFormFields(), $data);

        $this->view->set('form', $form, true);
        $this->view->set('data', $data, true);
        $this->view->set('url', $this->router->url(), true);
        $this->view->set('link_list', $this->router->url('admin/users'));
        $this->view->set('link_form', $this->router->url('admin/user'));
    }

    public function getFormFields()
    {
        $fields = [
            'id' => ['hidden'],
            'name' => [
                'text',
                'placeholder' => 'Enter Name',
                'showLabel' => false,
                'formClass' => 'form-control',
                'required' => 'required'
            ],
            'username' => ['text',
                'placeholder' => 'Enter user name',
                'showLabel' => false,
                'formClass' => 'form-control',
                'required' => 'required',
            ],
            'email' => ['email',
                'formClass' => 'form-control',
                'placeholder' => 'Enter Name',
                'showLabel' => false,
                // 'required' => 'required'
            ],
            'password' => ['password',
                'showLabel' => false,
                'formClass' => 'form-control'
            ],
            'confirm_password' => ['password',
                'showLabel' => false,
                'formClass' => 'form-control'
            ],
            'status' => ['option',
                'type' => 'radio',
                'formClass' => '',
                'options' => [
                    ['text'=>'Yes', 'value'=>1],
                    ['text'=>'No', 'value'=>0]
                ]
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
            $fields['password']['required'] = 'required';
            $fields['confirm_password']['required'] = 'required';
            $fields['modified_at'] = ['hidden'];
            $fields['modified_by'] = ['hidden'];
            $fields['created_at'] = ['hidden'];
            $fields['created_by'] = ['hidden'];
        }

        return $fields;
    }
}
