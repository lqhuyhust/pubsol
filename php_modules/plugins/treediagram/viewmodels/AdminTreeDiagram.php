<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\treediagram\viewmodels;

use SPT\Web\ViewModel;
use SPT\View\Gui\Form;

class AdminTreeDiagram extends ViewModel
{
    public static function register()
    {
        return [
            'layouts.backend.tree_diagram.form'
        ];
    }

    public function form()
    {
        $request = $this->container->get('request');
        $TreeDiagramEntity = $this->container->get('TreeDiagramEntity');
        $TreeDiagramModel = $this->container->get('TreeDiagramModel');
        $router = $this->container->get('router');

        $urlVars = $request->get('urlVars');
        $id = (int) $urlVars['id'];

        $data = $id ? $TreeDiagramEntity->findByPK($id) : [];
        $ignore = [];
        if ($data && $data['config'])
        {
            $config = json_decode($data['config'], true);
            if (is_array($config))
            {
                $config = $TreeDiagramModel->convertConfig($config);
            }
            $data['config'] = json_encode($config, JSON_UNESCAPED_UNICODE);
            $ignore = $TreeDiagramModel->findNotes($config);
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
            'link_list' => $router->url('tree-diagrams'),
            'link_form' => $router->url('tree-diagram'),
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
                'default' => $this->container->get('token')->value(),
            ],
        ];

        return $fields;
    }
}
