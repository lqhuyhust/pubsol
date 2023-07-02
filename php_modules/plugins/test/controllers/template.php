<?php
/**
 * SPT software - homeController
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 *
 */

namespace App\plugins\test\controllers;

use SPT\Web\ControllerMVVM;

class template extends ControllerMVVM
{
    public function detail()
    {
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.template.form');
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
            'name' => $this->request->post->get('name', '', 'string'),
            'description' => $this->request->post->get('description', '', 'string'),
            'parent_id' => $this->request->post->get('parent_id', 0, 'int'),
        ];

        $data = $this->TemplateModel->validate($data);
        if (!$data)
        {
            return $this->app->redirect(
                $this->router->url('templates')
            );
        }
        
        $try = $this->TemplateModel->add($data);

        if( !$try )
        {
            $msg = 'Error: Create Failed!';
            $this->session->set('flashMsg', $msg);
            return $this->app->redirect(
                $this->router->url('templates')
            );
        }
        else
        {
            $this->session->set('flashMsg', 'Create Successfully!');
            return $this->app->redirect(
                $this->router->url('templates')
            );
        }
    }

    public function update()
    {
        $id = $this->validateID(); 

        if(is_numeric($id) && $id)
        {
            $data = [
                'name' => $this->request->post->get('name', '', 'string'),
                'description' => $this->request->post->get('description', '', 'string'),
                'parent_id' => $this->request->post->get('parent_id', 0, 'int'),
                'id' => $id,
            ];
        
            $data = $this->TemplateModel->validate($data);
            if (!$data)
            {
                return $this->app->redirect(
                    $this->router->url('templates')
                );
            }
            
            $try = $this->TemplateModel->update($data);
            
            if($try) 
            {
                $this->session->set('flashMsg', 'Update Successfully!');
                return $this->app->redirect(
                    $this->router->url('templates')
                );
            }
            else
            {
                $this->session->set('flashMsg', 'Error: Update Failed!');
                return $this->app->redirect(
                    $this->router->url('templates')
                );
            }
        }

        $this->session->set('flashMsg', 'Error: Invalid Task!');
        return $this->app->redirect(
            $this->router->url('templates')
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
                if( $this->TemplateModel->remove( $id ) )
                {
                    $count++;
                }
            }
        }
        elseif( is_numeric($ids) )
        {
            if( $this->TemplateModel->remove($ids ) )
            {
                $count++;
            }
        }  
        

        $this->session->set('flashMsg', $count.' deleted record(s)');
        return $this->app->redirect(
            $this->router->url('templates'), 
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

    public function search()
    {
        $search = trim($this->request->get->get('search', '', 'string'));
        $ignores = $this->request->get->get('ignores', [], 'array');

        $data = $this->TemplateModel->search($search, $ignores);

        $this->app->set('format', 'json');
        $this->set('status' , 'success');
        $this->set('data' , $data);
        $this->set('message' , '');
        return;
    }
}