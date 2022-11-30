<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\users\viewmodels; 

use SPT\View\VM\JDIContainer\ViewModel; 
use SPT\View\Gui\Form;

class UserVM extends ViewModel
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

        if ($data)
        {
            $groups = $this->UserEntity->getGroups($data['id']);
            foreach ($groups as $group)
            {
                $data['groups'][] = $group['group_id'];
            }


            if (!file_exists(MEDIA_PATH. $data['avatar']) || !$data['avatar'])
            {
                $data['avatar'] = 'users/dummyUser.png';
            }
        }

        $form = new Form($this->getFormFields(), $data);

        $field = $form->getField('password');
        $field->value = '';

        $save_form = $id ? $this->router->url('admin/userUpdateSave/'. $id) : $this->router->url('admin/userAddSave');

        $this->view->set('form', $form, true);
        $this->view->set('data', $data, true);
        $this->view->set('url', $this->router->url(), true);
        $this->view->set('link_user_list', $this->router->url('admin/users'));
        $this->view->set('link_user_form_save', $save_form);
    }

    public function getFormFields()
    {
        $groups = $this->GroupEntity->list(0, 0);
        $options = [];
        foreach ($groups as $group)
        {
            $options[] = [
                'text' => $group['name'],
                'value' => $group['id'],
            ];
        }

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
            'groups' => ['option',
                'options' => $options,
                'type' => 'multiselect',
                'showLabel' => false,
                'formClass' => 'form-select',
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