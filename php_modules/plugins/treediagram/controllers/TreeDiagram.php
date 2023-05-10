<?php
/**
 * SPT software - homeController
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 *
 */

namespace App\plugins\treediagram\controllers;

use SPT\Web\MVVM\ControllerContainer as Controller;
use SPT\Response;

class TreeDiagram extends Admin {
    public function detail()
    {
        $this->isLoggedIn();

        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];

        $exist = $this->TreeDiagramEntity->findByPK($id);

        if(!empty($id) && !$exist)
        {
            $this->session->set('flashMsg', "Invalid note diagram");
            return $this->app->redirect(
                $this->router->url('tree-diagrams')
            );
        }
        $this->app->set('layout', 'backend.tree_diagram.form');
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
    }

    public function list()
    {
        $this->isLoggedIn();
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.tree_diagram.list');
    }

    public function add()
    {
        $this->isLoggedIn();

        //check title sprint
        $title = $this->request->post->get('title', '', 'string');
        $notes = $this->request->post->get('notes', '', 'string');
        $config = $this->request->post->get('config', '', 'string');
        $save_close = $this->request->post->get('save_close', '', 'string');

        if (!$title)
        {
            $this->session->set('flashMsg', 'Error: Title is required! ');
            return $this->app->redirect(
                $this->router->url('tree-diagram/0')
            );
        }

        // TODO: validate new add
        $newId =  $this->TreeDiagramEntity->add([
            'title' => $title,
            'config' => $config,
            'notes' => $notes,
            'created_by' => $this->user->get('id'),
            'created_at' => date('Y-m-d H:i:s'),
            'modified_by' => $this->user->get('id'),
            'modified_at' => date('Y-m-d H:i:s')
        ]);

        if( !$newId )
        {
            $msg = 'Error: Created Failed!';
            $this->session->set('flashMsg', $msg);
            return $this->app->redirect(
                $this->router->url('tree-diagram/0')
            );
        }
        else
        {
            $this->session->set('flashMsg', 'Created Successfully!');
            $link = $save_close ? 'tree-diagrams' : 'tree-diagram/'. $newId;
            return $this->app->redirect(
                $this->router->url($link)
            );
        }
    }

    public function update()
    {
        $ids = $this->validateID();

        // TODO valid the request input

        if(is_numeric($ids) && $ids)
        {
            $title = $this->request->post->get('title', '', 'string');
            $config = $this->request->post->get('config', '', 'string');
            $notes = $this->request->post->get('notes', '', 'string');
            $save_close = $this->request->post->get('save_close', '', 'string');

            if (!$title)
            {
                $this->session->set('flashMsg', 'Error: Title is required! ');
                return $this->app->redirect(
                    $this->router->url('tree-diagram/0')
                );
            }

            $try = $this->TreeDiagramEntity->update([
                'title' => $title,
                'config' => $config,
                'notes' => $notes,
                'modified_by' => $this->user->get('id'),
                'modified_at' => date('Y-m-d H:i:s'),
                'id' => $ids,
            ]);
            
            if($try)
            {
                $this->session->set('flashMsg', 'Updated successfully');
                $link = $save_close ? 'tree-diagrams' : 'tree-diagram/'. $ids;
                return $this->app->redirect(
                    $this->router->url($link)
                );
            }
            else
            {
                $msg = 'Error: Updated failed';
                $this->session->set('flashMsg', $msg);
                return $this->app->redirect(
                    $this->router->url('tree-diagram/'. $ids)
                );
            }
        }
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
                if( $this->TreeDiagramEntity->remove( $id ) )
                {
                    $count++;
                }
            }
        }
        elseif( is_numeric($ids) )
        {
            if( $this->TreeDiagramEntity->remove($ids ) )
            {
                $count++;
            }
        }


        $this->session->set('flashMsg', $count.' deleted record(s)');
        return $this->app->redirect(
            $this->router->url('tree-diagrams'),
        );
    }

    public function validateID()
    {
        $this->isLoggedIn();

        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];

        if(empty($id))
        {
            $ids = $this->request->post->get('ids', [], 'array');
            if(count($ids)) return $ids;

            $this->session->set('flashMsg', 'Invalid note diagram');
            return $this->app->redirect(
                $this->router->url('tree-diagrams'),
            );
        }

        return $id;
    }
}