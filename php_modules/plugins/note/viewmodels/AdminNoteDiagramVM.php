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

class AdminNoteDiagramVM extends ViewModel
{
    protected $alias = 'AdminNoteDiagramVM';
    protected $layouts = [
        'layouts.backend.note_diagram' => [
            'form',
        ],
    ];

    public function form()
    {
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];
        $this->set('id', $id, true);

        $data = $id ? $this->NoteDiagramEntity->findByPK($id) : [];

        if ($data && $data['config'])
        {
            $config = json_decode($data['config'], true);
            if (is_array($config))
            {
                $config = $this->NoteDiagramModel->convertConfig($config);
            }
            
            $data['config'] = json_encode($config);
        }

        $form = new Form($this->getFormFields(), $data);
        $this->set('form', $form, true);
        $this->set('data', $data, true);
        $this->set('title_page_edit', $data && $data['title'] ? $data['title'] : 'New Diagrams', true);
        $this->set('url', $this->router->url(), true);
        $this->set('link_note', $this->router->url('note/'), true);
        $this->set('link_request', $this->router->url('note/request'), true);
        $this->set('link_detail_request', $this->router->url('detail-request'), true);
        $this->set('link_list', $this->router->url('note-diagrams'), true);
        $this->set('link_form', $this->router->url('note-diagram'), true);
        $this->set('link_search', $this->router->url('note/search'));
    }

    public function getFormFields()
    {
        $fields = [
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
            'notes' => [
                'hidden',
            ],
            'config' => [
                'hidden',
            ],
            'token' => ['hidden',
                'default' => $this->app->getToken(),
            ],
        ];

        return $fields;
    }
}
