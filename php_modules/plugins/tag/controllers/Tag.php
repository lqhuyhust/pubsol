<?php
/**
 * SPT software - homeController
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 *
 */

namespace App\plugins\tag\controllers;

use SPT\Web\MVVM\ControllerContainer as Controller;

class Tag extends Admin {

    public function list()
    {
        $this->isLoggedIn();
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.tag.list');
    }

    public function add()
    {
        $this->isLoggedIn();

        $name = $this->request->post->get('name', '', 'string');
        $description = $this->request->post->get('description', '', 'string');
        $parent_id = $this->request->post->get('parent_id', 0, 'int');

        if (!$name)
        {
            $this->session->set('flashMsg', 'Error: Name can\'t empty! ');
            return $this->app->redirect(
                $this->router->url('tags')
            );
        }
        
        // TODO: validate new add
        $newId =  $this->TagEntity->add([
            'name' => $name,
            'description' => $description,
            'parent_id' => $parent_id,
        ]);

        if( !$newId )
        {
            $msg = 'Error: Create Failed!';
            $this->session->set('flashMsg', $msg);
            return $this->app->redirect(
                $this->router->url('tags')
            );
        }
        else
        {
            $this->session->set('flashMsg', 'Create Successfully!');
            return $this->app->redirect(
                $this->router->url('tags')
            );
        }
    }

    public function update()
    {
        $id = $this->validateID(); 

        if(is_numeric($id) && $id)
        {
            $name = $this->request->post->get('name', '', 'string');
            $description = $this->request->post->get('description', '', 'string');
            $parent_id = $this->request->post->get('parent_id', 0, 'int');
    
            if (!$name)
            {
                $this->session->set('flashMsg', 'Error: Name can\'t empty! ');
                return $this->app->redirect(
                    $this->router->url('tags')
                );
            }
            
            $try = $this->TagEntity->update([
                'name' => $name,
                'description' => $description,
                'parent_id' => $parent_id,
                'id' => $id,
            ]);
            
            if($try) 
            {
                $this->session->set('flashMsg', 'Update Successfully!');
                return $this->app->redirect(
                    $this->router->url('tags')
                );
            }
            else
            {
                $this->session->set('flashMsg', 'Error: Update Failed!');
                return $this->app->redirect(
                    $this->router->url('tags')
                );
            }
        }

        $this->session->set('flashMsg', 'Error: Invalid Task!');
        return $this->app->redirect(
            $this->router->url('tags')
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
                if( $this->TagModel->remove( $id ) )
                {
                    $count++;
                }
            }
        }
        elseif( is_numeric($ids) )
        {
            if( $this->TagModel->remove($ids ) )
            {
                $count++;
            }
        }  
        

        $this->session->set('flashMsg', $count.' deleted record(s)');
        return $this->app->redirect(
            $this->router->url('tags'), 
        );
    }

    public function validateID()
    {
        $this->isLoggedIn();
        $urlVars = $this->request->get('urlVars');
        $id = $urlVars ? (int) $urlVars['id'] : 0;

        if(empty($id))
        {
            $ids = $this->request->post->get('ids', [], 'array');
            if(count($ids)) return $ids;

            $this->session->set('flashMsg', 'Invalid Tag');
            return $this->app->redirect(
                $this->router->url('tags'),
            );
        }

        return $id;
    }

    public function search()
    {
        $this->isLoggedIn();

        $name = $this->request->get->get('search', '', 'string');
        $ignores = $this->request->get->get('ignores', [], 'array');

        $where = [];

        if( !empty($name) )
        {
            $where[] = "(`name` LIKE '%".$name."%' )";
        }

        if ($ignores)
        {
            $where[] = "id NOT IN (". implode(',', $ignores).")";
        }

        $data = $this->TagEntity->list(0,100, $where);
        foreach($data as &$item)
        {
            if ($item['parent_id'])
            {
                $tmp = $this->TagEntity->findByPK($item['parent_id']);
                if ($tmp)
                {
                    $item['name'] = $tmp['name']. ' > '. $item['name'];
                }
            }
        }
        $this->app->set('format', 'json');
        $this->set('status' , 'success');
        $this->set('data' , $data);
        $this->set('message' , '');
        return;
    }
}