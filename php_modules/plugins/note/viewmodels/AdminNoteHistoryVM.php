<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\note\viewmodels;

use SPT\View\VM\JDIContainer\ViewModel;
use SPT\View\Gui\Form;

class AdminNoteHistoryVM extends ViewModel
{
    protected $alias = 'AdminNoteHistoryVM';
    protected $layouts = [
        'layouts.backend.note_history' => [
            'form',
        ],
    ];

    public function form()
    {
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];
        $this->set('id', $id, true);

        $version = $id ? $this->NoteHistoryEntity->findByPK($id) : [];

        if ($version)
        {
            if ($version)
            {
                $user_tmp = $this->UserEntity->findByPK($version['created_by']);
                $version['created_by'] = $user_tmp ? $user_tmp['name'] : '';
                $data = json_decode($version['meta_data'], true);
                $data['id'] = $id;
                $data['title'] = $data['title'] . ' - '. $version['created_at']. ' - by '. $version['created_by'];
            }
        }

        if ($data)
        {
            $data['description_sheetjs'] = base64_encode(strip_tags($data['description']));
            $data['description_presenter'] = $data['description'];
            $versions = $this->NoteHistoryEntity->list(0, 0, ['note_id' => $data['id']], 'id desc');
            $versions = $versions ? $versions : [];

            foreach($versions as &$item)
            {
                $user_tmp = $this->UserEntity->findByPK($item['created_by']);
                $item['created_by'] = $user_tmp ? $user_tmp['name'] : '';
            }

            $data['versions'] = $versions;
        }
        
        $data_tags = [];
        if (!empty($data['tags'])){
            $where[] = "(`id` IN (".$data['tags'].") )";
            $data_tags = $this->TagEntity->list(0, 1000, $where);
        }
        $attachments = $this->AttachmentEntity->list(0, 0, ['note_id = '. $id]);
        $form = new Form($this->getFormFields(), $data);
        $view_mode = true;

        $this->set('form', $form, true);
        $this->set('data', $data, true);
        $this->set('view_mode', $view_mode, true);
        $this->set('data_tags', $data_tags, true);
        $this->set('version', $version, true);
        $this->set('attachments', $attachments);
        $this->set('title_page', $data && $data['title'] ? $data['title'] : 'New Note', true);
        $this->set('url', $this->router->url(), true);
        $this->set('link_list', $this->router->url('note/'. $version['note_id']), true);
        $this->set('link_form', $this->router->url('note/version'), true);
        $this->set('link_form_attachment', $this->router->url('attachment'));
        $this->set('link_tag', $this->router->url('tag'));
    }

    public function getFormFields()
    {
        $fields = [
            'description' => [
                'tinymce',
                'showLabel' => false,
                'formClass' => 'd-none',
            ],
            'description_sheetjs' => [
                'sheetjs',
                'showLabel' => false,
                'formClass' => 'field-sheetjs',
            ],
            'description_presenter' => [
                'presenter',
                'showLabel' => false,
                'formClass' => 'field-presenter',
            ],
            'note' => [
                'textarea',
                'showLabel' => false,
                'placeholder' => 'Note',
                'formClass' => 'form-control',
                ''
            ],
            'file' => [
                'file',
                'showLabel' => false,
                'formClass' => 'form-control',
            ],
            'title' => [
                'text',
                'showLabel' => false,
                'placeholder' => 'New Title',
                'formClass' => 'form-control border-0 border-bottom fs-2 py-0',
                'required' => 'required',
            ],
            'tags' => [
                'text',
                'showLabel' => false,
                'placeholder' => 'Tags',
                'formClass' => 'form-control',
            ],
            'token' => ['hidden',
                'default' => $this->app->getToken(),
            ],
        ];

        return $fields;
    }
}
