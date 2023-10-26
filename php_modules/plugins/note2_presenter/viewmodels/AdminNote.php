<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\note2_presenter\viewmodels;

use SPT\Web\ViewModel;
use SPT\Web\Gui\Form;

class AdminNote extends ViewModel
{
    public static function register()
    {
        return [
            'layout' => [
                'backend.form',
                'backend.preview',
                'backend.history'
            ]
        ];
    }
    
    private function getItem()
    {
        $urlVars = $this->request->get('urlVars');
        $id = $urlVars && isset($urlVars['id']) ? (int) $urlVars['id'] : 0;

        $data = $this->NotePresenterModel->getDetail($id);
        $data_form = $this->session->getform('note_presenter', []);
        $this->session->setform('note_presenter', []);
        $data = $data_form ? $data_form : $data;
        
        return $data;
    }

    public function form()
    {
        $data = $this->getItem();
        $id = isset($data['id']) ? $data['id'] : 0;

        $form = new Form($this->getFormFields(), $data);

        $history = $this->HistoryModel->list(0, 0, ['object' => 'note', 'object_id' => $id]);
        return [
            'id' => $id,
            'form' => $form,
            'history' => $history,
            'data' => $data,
            'title_page_edit' => $data && $data['title'] ? $data['title'] : 'New Note',
            'link_history' => $this->router->url('history/note-presenter'),
            'url' => $this->router->url(),
            'link_list' => $this->router->url('notes'),
            'link_form' => $id ? $this->router->url('note2/edit') : $this->router->url('new-note2/presenter'),
            'link_preview' => $data['status'] != '-1' ? $this->router->url('note2/preview/'. $id) : '',
        ];
        
    }

    public function history()
    {
        $urlVars = $this->request->get('urlVars');
        $id = $urlVars && isset($urlVars['id']) ? (int) $urlVars['id'] : 0;

        $history = $this->HistoryModel->detail($id);

        $data = $this->NoteHtmlModel->getDetail($history['object_id']);
        $data['data'] = $history['data'];

        $form = new Form($this->getFormFields(), $data);

        $button_header = [
            [
                'link' => isset($data['id']) ? $this->router->url('note2/edit/'.$data['id']) : $this->router->url('notes') ,
                'class' => 'btn btn-outline-secondary',
                'title' => 'Cancel',
            ],
            [
                'link' => '',
                'class' => 'btn ms-2 btn-outline-success button-rollback',
                'title' => 'Rollback',
            ],
        ];

        return [
            'id' => $id,
            'form' => $form,
            'button_header' => $button_header,
            'data' => $data,
            'title_page' => isset($data['id']) ? $data['title'] . ' - Modified at: '. $history['created_at'] : 'Modified at: '. $history['created_at']  ,
            'url' => $this->router->url(),
            'link_history' => $this->router->url('history/note-presenter'),
            'link_form' => $this->router->url('history/note-presenter'),
        ];
    }

    public function getFormFields()
    {
        $fields = [
            'notice' => [
                'textarea',
                'label' => '',
                'placeholder' => 'Notice',
                'formClass' => 'form-control',
            ],
            'data' => [
                'presenter',
                'label' => 'Presenter',
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

    public function preview()
    {
        $data = $this->getItem();
        $id = isset($data['id']) ? $data['id'] : 0;

        $form = new Form($this->getFormFields(), $data);

        $button_header = [
            [
                'link' => $this->router->url('notes'),
                'class' => 'btn btn-outline-secondary',
                'title' => 'Cancel',
            ],
        ];

        $asset = $this->PermissionModel->getAccessByUser();
        if (in_array('note_manager', $asset) || in_array('note_update', $asset))
        {
            $button_header[] = [
                'link' => $this->router->url('note2/edit/'. $id),
                'class' => 'btn ms-2 btn-outline-success',
                'title' => 'Edit',
            ];
        }

        return [
            'id' => $id,
            'form' => $form,
            'data' => $data,
            'button_header' => $button_header,
            'title_page' => $data && $data['title'] ? $data['title'] : '',
            'url' => $this->router->url(),
        ];
    }
}
