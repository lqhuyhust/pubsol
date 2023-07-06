<?php
/**
 * SPT software - homeController
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 *
 */

namespace App\plugins\page\controllers;

use SPT\Web\ControllerMVVM;

class modulehtml extends ControllerMVVM
{
    public function detail()
    {
        $this->app->set('page', 'backend-full');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.module.html.form');
    }

    public function list()
    {
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.template.list');
    }

    public function add()
    {
        $data = [
            'title' => $this->request->post->get('title', '', 'string'),
            'content' => $this->request->post->get('content', '', 'string'),
            'template_id' => $this->request->post->get('template_id', 0, 'int'),
            'position_name' => $this->request->post->get('position_name', '', 'string'),
        ];

        $try = $this->ModuleHtmlModel->add($data);

        if( !$try )
        {
            return $this->app->redirect(
                $this->router->url('module/html')
            );
        }
        else
        {
            $this->session->set('flashMsg', 'Create Successfully!');
            return $this->app->redirect(
                $this->router->url('module/html/'. $try)
            );
        }
    }

    public function update()
    {
        $id = $this->validateID(); 

        if(is_numeric($id) && $id)
        {
            $data = [
                'title' => $this->request->post->get('title', '', 'string'),
                'content' => $this->request->post->get('content', '', 'string'),
                'template_id' => $this->request->post->get('template_id', 0, 'int'),
                'position_name' => $this->request->post->get('position_name', '', 'string'),
                'id' => $id,
            ];
    
            $try = $this->ModuleHtmlModel->update($data);
            
            if($try) 
            {
                $this->session->set('flashMsg', 'Update Successfully!');
            }

            return $this->app->redirect(
                $this->router->url('module/html/'. $id)
            );
        }

        $this->session->set('flashMsg', 'Error: Invalid Task!');
        return $this->app->redirect(
            $this->router->url('module/html/0')
        );
    }

    public function delete()
    {
        $ids = $this->validateID();
        $count = 0;
        if( is_array($ids))
        {
            foreach($ids as $id)
            {
                //Delete file in source
                if( $this->ModuleHtmlModel->remove( $id ) )
                {
                    $count++;
                }
            }
        }
        elseif( is_numeric($ids) )
        {
            if( $this->ModuleHtmlModel->remove($ids ) )
            {
                $count++;
            }
        }  

        $this->app->set('format', 'json');
        $this->set('status' , 'success');
        return;
    }

    public function validateID()
    {
        $urlVars = $this->request->get('urlVars');
        $id = $urlVars ? (int) $urlVars['id'] : 0;

        if(empty($id))
        {
            $ids = $this->request->post->get('ids', [], 'array');
            if(count($ids)) return $ids;

            $this->session->set('flashMsg', 'Invalid Module');
            return $this->app->redirect(
                $this->router->url('templates'),
            );
        }

        return $id;
    }
}