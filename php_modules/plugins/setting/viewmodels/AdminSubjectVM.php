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

class AdminSubjectVM extends ViewModel
{
    protected $alias = 'AdminSubjectVM';
    protected $layouts = [
        'layouts.backend.subject' => [
            'form'
        ]
    ];

    public function form()
    {
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];
        $this->set('id', $id, true);

        $data = $id ? $this->SubEntity->findByPK($id) : [];

        if ($data)
        {
            $file_name = PUBLIC_PATH.'media/images1/'. $data['sub_img'] ;
            if (file_exists($file_name)) { 
                $data['sub_img_url'] = $this->router->url('media/images1/'. $data['sub_img'] );
            }else
            {
                $data['sub_img_url'] = '';
            }

            $file_name = PUBLIC_PATH.'media/images1/'. $data['sub_hdr_img'] ;
            if (file_exists($file_name)) { 
                $data['sub_hdr_img_url'] = $this->router->url('media/images1/'. $data['sub_hdr_img'] );
            }else
            {
                $data['sub_hdr_img_url'] = '';
            }

            $tops = $this->TopSubEntity->listTopic(0, 0, $id);
            $data['topics'] = [];

            foreach($tops as $item)
            {
                $data['topics'][] = $item['topic_id'];
            }
        }
        $subject_image = $this->SubImageEntity->list(0, 0, ['subject_id' => $id]);
        $subject_fact = $this->SubFactEntity->list(0, 0, ['subject_id' => $id]);
        foreach($subject_image as &$item)
        {
            $file_image = PUBLIC_PATH. "media/images2/" . $item['info_image'];
            $item['info_image_url'] = file_exists($file_image) ? $this->router->url("media/images2/" . $item['info_image']) : '';

            $file_sound = PUBLIC_PATH. "media/sound/" . $item['info_sound'];
            $item['info_sound_url'] = file_exists($file_sound) ? $this->router->url("media/sound/" . $item['info_sound']) : '';
        }

        $this->set('subject_image', $subject_image);
        $this->set('subject_fact', $subject_fact);
        $form = new Form($this->getFormFields(), $data);

        $save_form = $id ? $this->router->url('admin/user/'. $id) : $this->router->url('admin/user/0');
        $title_page = $id ? 'Update Report' : 'New Report';
        $this->view->set('form', $form, true);
        $this->view->set('title_page', $title_page, true);
        $this->view->set('data', $data, true);
        $this->view->set('url', $this->router->url(), true);
        $this->view->set('link_list', $this->router->url('admin/subjects'));
        $this->view->set('link_form', $this->router->url('admin/subject'));
    }

    public function getFormFields()
    {
        $topics = $this->TopicEntity->list(0, 0, [], 'topic_name asc');
        $options = [];
        foreach ($topics as $item)
        {
            $options[] = [
                'text' => strip_tags($item['topic_name']),
                'value' => $item['topic_id'],
            ];
        }
        $fields = [
            'id' => ['hidden'],
            'sub_name' => [
                'text',
                'placeholder' => 'Subject Name',
                'showLabel' => false,
                'formClass' => 'form-control',
                'required' => 'required'
            ],
            'sub_search' => [
                'tinymce',
                'placeholder' => 'Subject Search',
                'showLabel' => false,
                'formClass' => 'form-control',
                'required' => ''
            ],
            'sub_text' => [
                'tinymce',
                'placeholder' => 'Subject Text',
                'showLabel' => false,
                'formClass' => 'form-control',
                'required' => ''
            ],
            'sub_resource' => [
                'tinymce',
                'placeholder' => 'Subject Resource',
                'showLabel' => false,
                'formClass' => 'form-control',
                'required' => ''
            ],
            'sub_citation' => [
                'tinymce',
                'placeholder' => 'Report Citation',
                'showLabel' => false,
                'formClass' => 'form-control',
                'required' => ''
            ],
            'sub_active' => ['option',
                'showLabel' => false,
                'type' => 'radio',
                'formClass' => '',
                'options' => [
                    ['text'=>'Yes', 'value'=>'Y'],
                    ['text'=>'No', 'value'=>'N']
                ],
                'default' => 'Y',
            ],
            'topics' => ['option',
                'options' => $options,
                'type' => 'multiselect',
                'showLabel' => false,
                'formClass' => 'form-select',
            ],
            'token' => ['hidden',
                'default' => $this->app->getToken(),
            ],
            'sub_hdr_img' => ['hidden',
            ],
            'sub_img' => ['hidden',
            ],
        ];

        return $fields;
    }
}