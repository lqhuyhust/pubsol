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

class GroupVM extends ViewModel
{
    protected $alias = 'AdminGroupVM';
    protected $layouts = [
        'layouts.backend.userGroup.form'
    ];

    public function form()
    {
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];
        $this->view->set('id', $id, true);

        $data = $id ? $this->GroupEntity->findByPK($id) : [];
        if ($data['access'])
        {
            $data['access'] = (array) json_decode($data['access']);
        }
        $form = new Form($this->getFormFields(), $data);

        $save_form = $id ? $this->router->url('admin/userGroupUpdateSave/'. $id) : $this->router->url('admin/userGroupAddSave');

        $this->view->set('form', $form, true);
        $this->view->set('data', $data, true);
        $this->view->set('url', $this->router->url(), true);
        $this->view->set('link_user_group_list', $this->router->url('admin/userGroups'));
        $this->view->set('link_user_group_form', $save_form);
    }

    public function getFormFields()
    {
        $key_access = $this->UserModel->getRightAccess();
        $option = [];
        foreach ($key_access as $key)
        {
            $option[] = [
                'text' => $key,
                'value' => $key,
            ];
        }
        $fields = [
            'id' => ['hidden'],
            'name' => ['text',
                'showLabel' => false,
                'formClass' => 'form-control',
                'required' => 'required'
            ],
            'description' => ['textarea',
                'formClass' => 'form-control',
                'placeholder' => ''
            ],
            'access' => ['option',
                'showLabel' => false,
                'placeholder' => 'Select Right Access',
                'type' => 'multiselect',
                'formClass' => 'form-select',
                'options' => $option
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
            $fields['modified_at'] = ['hidden'];
            $fields['modified_by'] = ['hidden'];
            $fields['created_at'] = ['hidden'];
            $fields['created_by'] = ['hidden'];
        }

        return $fields;
    }
}