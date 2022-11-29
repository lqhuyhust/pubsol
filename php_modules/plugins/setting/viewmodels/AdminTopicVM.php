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

class AdminTopicVM extends ViewModel
{
    protected $alias = 'AdminTopicVM';
    protected $layouts = [
        'layouts.backend.topic' => [
            'form'
        ]
    ];

    public function form()
    {
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];
        $this->set('id', $id, true);

        $data = $id ? $this->TopicEntity->findByPK($id) : [];

        if ($data)
        {
            $temp = "media/images1/topic_" . $data['topic_id'] . "_text.jpg";
            $file_name = PUBLIC_PATH . $temp;
            if (file_exists($file_name)) { 
                $data['image'] = $this->router->url($temp);
            }
        }

        $form = new Form($this->getFormFields(), $data);

        $save_form = $id ? $this->router->url('admin/user/'. $id) : $this->router->url('admin/user/0');
        $title_page = $id ? 'Update Topic Header' : 'New Topic Header';
        $this->view->set('form', $form, true);
        $this->view->set('title_page', $title_page, true);
        $this->view->set('data', $data, true);
        $this->view->set('url', $this->router->url(), true);
        $this->view->set('link_list', $this->router->url('admin/topics'));
        $this->view->set('link_form', $this->router->url('admin/topic'));
    }

    public function getFormFields()
    {
        $fields = [
            'id' => ['hidden'],
            'topic_name' => [
                'text',
                'placeholder' => 'Topic Name',
                'showLabel' => false,
                'formClass' => 'form-control',
                'required' => 'required'
            ],
            'topic_active' => ['option',
                'showLabel' => false,
                'type' => 'radio',
                'formClass' => '',
                'options' => [
                    ['text'=>'Yes', 'value'=>'Y'],
                    ['text'=>'No', 'value'=>'N']
                ],
                'default' => 'Y',
            ],
            'token' => ['hidden',
                'default' => $this->app->getToken(),
            ],
        ];

        return $fields;
    }
}