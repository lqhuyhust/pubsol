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

class page extends ControllerMVVM
{
    public function detail()
    {
        $this->PageEntity->checkAvailability();
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.page.form');
    }

    public function list()
    {
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.page.list');
    }

    public function add()
    {
        $data = [
            'template_id' => $this->request->post->get('template_id', '', 'string'),
            'title' => $this->request->post->get('title', '', 'string'),
            'slug' => $this->request->post->get('slug', '', 'string'),
            'content_type' => $this->request->post->get('content_type', '', 'string'),
        ];

        $try = $this->PageModel->add($data);
        
        if( !$try )
        {
            $msg = 'Error: Create Failed!';
            $this->session->set('flashMsg', $msg);
            return $this->app->redirect(
                $this->router->url('page/0')
            );
        }
        else
        {
            $this->session->set('flashMsg', 'Create Successfully!');
            return $this->app->redirect(
                $this->router->url('pages')
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
                'slug' => $this->request->post->get('slug', '', 'string'),
                'template_id' => $this->request->post->get('template_id', '', 'string'),
                'content_type' => $this->request->post->get('content_type', '', 'string'),
                'id' => $id,
            ];
            
            $try = $this->PageModel->update($data);
            if($try) 
            {
                $this->session->set('flashMsg', 'Update Successfully!');
                return $this->app->redirect(
                    $this->router->url('pages')
                );
            }
            else
            {
                $this->session->set('flashMsg', 'Error: Update Failed!');
                return $this->app->redirect(
                    $this->router->url('page/'. $id)
                );
            }
        }

        $this->session->set('flashMsg', 'Error: Invalid Page!');
        return $this->app->redirect(
            $this->router->url('pages')
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
                if( $this->PageModel->remove( $id ) )
                {
                    $count++;
                }
            }
        }
        elseif( is_numeric($ids) )
        {
            if( $this->PageModel->remove($ids ) )
            {
                $count++;
            }
        }  
        

        $this->session->set('flashMsg', $count.' deleted record(s)');
        return $this->app->redirect(
            $this->router->url('pages'), 
        );
    }

    public function validateID()
    {
        $urlVars = $this->request->get('urlVars');
        $id = $urlVars ? (int) $urlVars['id'] : 0;

        if(empty($id))
        {
            $ids = $this->request->post->get('ids', [], 'array');
            if(count($ids)) return $ids;

            $this->session->set('flashMsg', 'Invalid Template');
            return $this->app->redirect(
                $this->router->url('templates'),
            );
        }

        return $id;
    }

    public function basic()
    {
        $currentPage = $this->app->get('currentPage');
        $widgetPosition = is_array($currentPage) && isset($currentPage['widgetPosition']) ? $currentPage['widgetPosition'] : [];
        $this->app->set('layout', 'frontend.page.basic');
        $this->set('widgetPosition', $widgetPosition);
        return true;
    }
}