<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\note2_attachment\viewmodels;

use SPT\Web\ViewModel;
use SPT\Web\Gui\Form;

class AdminNote extends ViewModel
{
    public static function register()
    {
        return [
            'layout'=>[
                'backend.form',
                'backend.preview'
            ]
        ];
    }
    
    private function getItem()
    {
        $urlVars = $this->request->get('urlVars');
        $id = $urlVars && isset($urlVars['id']) ? (int) $urlVars['id'] : 0;

        $data = $id ? $this->NoteAttachment->getDetail($id) : [];

        return $data;
    }

    public function form()
    {
        $data = $this->getItem();
        $id = isset($data['id']) ? $data['id'] : 0;

        $form = new Form($this->getFormFields(), $data);
        
        return [
            'id' => $id,
            'form' => $form,
            'data' => $data,
            'title_page_edit' => $data && $data['title'] ? $data['title'] : 'New Note',
            'url' => $this->router->url(),
            'link_list' => $this->router->url('note2'),
            'link_form' => $id ? $this->router->url('note2/detail') : $this->router->url('new-note2/file'),
        ];
        
    }

    public function getFormFields()
    {
        $fields = [
            'notice' => [
                'textarea',
                'label' => 'Notice',
                'placeholder' => 'Notice',
                'formClass' => 'form-control',
            ],
            'file' => [
                'file',
                'label' => 'File',
                'required' => 'required',
                'formClass' => 'form-control',
            ],
            'title' => [
                'text',
                'showLabel' => false,
                'placeholder' => 'New Title',
                'formClass' => 'form-control border-0 border-bottom fs-2 py-0',
                'required' => 'required',
            ],
            'token' => ['hidden',
                'default' => $this->token->value(),
            ],
        ];

        return $fields;
    }
}
