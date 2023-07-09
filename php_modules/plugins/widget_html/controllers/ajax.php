<?php
/**
 * SPT software - widget ajax controller
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: ajax controller for a widget
 *
 */

namespace App\plugins\widget_html\controllers;

use SPT\Web\ControllerMVVM;

class ajax extends ControllerMVVM
{
    public function detail()
    {
        $this->app->set('page', 'backend-full');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'form');
    }

    public function add()
    {
        $data = [
            'title' => $this->request->post->get('title', '', 'string'),
            'content' => $this->request->post->get('content', '', 'string'),
            'template_id' => $this->request->post->get('template_id', 0, 'int'),
            'position' => $this->request->post->get('position', '', 'string'),
        ];

        if( $this->WidgetHtmlModel->add($data) )
        {
            $this->app->set('layout', 'success');
        }
        else
        {
            $this->session->set('flashMsg', 'Create failed.'. $this->WidgetHtmlModel->getError()); 
            $this->app->set('layout', 'form');
        }

        $this->app->set('page', 'backend-full');
        $this->app->set('format', 'html');
    }

    public function update()
    {
        if($id = $this->WidgetHtmlModel->getCurrentId())
        {
            $data = [
                'title' => $this->request->post->get('title', '', 'string'),
                'content' => $this->request->post->get('content', '', 'string'),
                'template_id' => $this->request->post->get('template_id', 0, 'int'),
                'position' => $this->request->post->get('position', '', 'string'),
                'id' => $id,
            ];
            
            if($this->WidgetHtmlModel->update($data)) 
            {
                $this->app->set('layout', 'success');
            }
            else
            {
                $this->session->set('flashMsg', 'Update failed.'. $this->WidgetHtmlModel->getError()); 
                $this->app->set('layout', 'form');
            }
        }
        else
        {
            $this->session->set('flashMsg', 'Error: Invalid ID Widget');
            $this->app->set('layout', 'form');
        }

        $this->app->set('page', 'backend-full');
        $this->app->set('format', 'html');
    }

    public function delete()
    {
        if($id = $this->WidgetHtmlModel->getCurrentId())
        {
            $this->WidgetHtmlModel->remove( $id );
        }
        $this->set('status', 'success');
        $this->app->set('format', 'json');
    }
}