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

    public static function register()
    {
        return [
            'layouts.backend.note_diagram.form'
        ];
    }

    public function form()
    {
        $request = $this->container->get('request');
        $NoteDiagramEntity = $this->container->get('NoteDiagramEntity');
        $NoteDiagramModel = $this->container->get('NoteDiagramModel');
        $router = $this->container->get('router');

        $urlVars = $request->get('urlVars');
        $id = (int) $urlVars['id'];

        $data = $id ? $NoteDiagramEntity->findByPK($id) : [];
        $ignore = [];
        if ($data && $data['config'])
        {
            $config = json_decode($data['config'], true);
            if (is_array($config))
            {
                $config = $NoteDiagramModel->convertConfig($config);
            }
            $data['config'] = json_encode($config, JSON_UNESCAPED_UNICODE);
            $ignore = $NoteDiagramModel->findNotes($config);
        }

        $form = new Form($this->getFormFields(), $data);
        return [
            'id' => $id,
            'form' => $form,
            'data' => $data,
            'ignore' => $ignore,
            'title_page_edit' => $data && $data['title'] ? $data['title'] : 'New Diagrams',
            'url' => $router->url(),
            'link_note' => $router->url('note/'),
            'link_request' => $router->url('note/request'),
            'link_detail_request' => $router->url('detail-request'),
            'link_list' => $router->url('note-diagrams'),
            'link_form' => $router->url('note-diagram'),
            'link_search' => $router->url('note/search'),
        ];
        
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
                'default' => $this->container->get('token')->getToken(),
            ],
        ];

        return $fields;
    }
}
