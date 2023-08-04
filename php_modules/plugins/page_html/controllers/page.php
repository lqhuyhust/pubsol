<?php
/**
 * SPT software - homeController
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 *
 */

namespace App\plugins\page_html\controllers;

use SPT\Web\ControllerMVVM;

class page extends ControllerMVVM
{
    public function newform()
    {
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.page.form');
    }

    public function detail()
    {
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.page.form');
    }

    public function add()
    {
        $data = [
            'template_id' => $this->request->post->get('template_id', '', 'string'),
            'title' => $this->request->post->get('title', '', 'string'),
            'data' => $this->request->post->get('data', '', 'string'),
            'slug' => $this->request->post->get('slug', '', 'string'),
        ];

        $try = $this->PageHtmlModel->add($data);
        
        if( !$try )
        {
            $this->session->set('flashMsg', $this->PageHtmlModel->getError());
            return $this->app->redirect(
                $this->router->url('new-page/html')
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
                'data' => $this->request->post->get('data', '', 'string'),
                'template_id' => $this->request->post->get('template_id', '', 'string'),
                'id' => $id,
            ];
            
            $try = $this->PageHtmlModel->update($data);
            if($try) 
            {
                $this->session->set('flashMsg', 'Update Successfully!');
                return $this->app->redirect(
                    $this->router->url('pages')
                );
            }
            else
            {
                $this->session->set('flashMsg', 'Error: '. $this->PageHtmlModel->getError());
                return $this->app->redirect(
                    $this->router->url('page/detail/'. $id)
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
                if( $this->PageHtmlModel->remove( $id ) )
                {
                    $count++;
                }
            }
        }
        elseif( is_numeric($ids) )
        {
            if( $this->PageHtmlModel->remove($ids ) )
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
}