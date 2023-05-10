<?php
/**
 * SPT software - homeController
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 *
 */

namespace App\plugins\treephp\controllers;

use SPT\Web\MVVM\ControllerContainer as Controller;
use SPT\Response;

class TreeDiagram extends Admin {
    public function detail()
    {
        $this->isLoggedIn();

        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];

        $exist = $this->TreePhpEntity->findByPK($id);

        if(!empty($id) && !$exist)
        {
            $this->session->set('flashMsg', "Invalid note diagram");
            return $this->app->redirect(
                $this->router->url('tree-phps')
            );
        }
        $this->app->set('layout', 'backend.tree_php.form');
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
    }

    public function list()
    {
        $this->isLoggedIn();
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.tree_php.list');
    }

    public function add()
    {
        $this->isLoggedIn();

        //check title sprint
        $title = $this->request->post->get('title', '', 'string');
        $structure = $this->request->post->get('structure', '', 'string');
        $save_close = $this->request->post->get('save_close', '', 'string');
        
        if (!$title)
        {
            $this->session->set('flashMsg', 'Error: Title is required! ');
            return $this->app->redirect(
                $this->router->url('tree-php/0')
            );
        }

        // TODO: validate new add
        $newId =  $this->TreePhpEntity->add([
            'title' => $title,
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
                $this->router->url('tree-php/0')
            );
        }
        else
        {
            // save struct
            $structure = json_decode($structure, true);
            foreach($structure as $item)
            {
                $this->TreeStructureEntity->add([
                    'diagram_id' => $newId,
                    'note_id' => $item['id'],
                    'tree_position' => $item['id'] ? $item['position'] : 0,
                    'tree_level' => $item['id'] ? $item['level'] : 0,
                        'parent_id' => $item['id'] ? $item['parent'] : 0,
                    'tree_left' => 0,
                    'tree_right' => 0,
                ]);
            }
            $try = $this->TreeStructureEntity->rebuild($newId);
            if (!$try)
            {
                $msg = 'Error: Save Structure Fail!';
                $this->session->set('flashMsg', $msg);
                return $this->app->redirect(
                    $this->router->url('tree-php/'. $newId)
                );
            }
            $this->session->set('flashMsg', 'Created Successfully!');
            $link = $save_close ? 'tree-phps' : 'tree-php/'. $newId;
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
            $structure = $this->request->post->get('structure', '', 'string');
            $removes = $this->request->post->get('removes', '', 'string');
            $save_close = $this->request->post->get('save_close', '', 'string');

            if (!$title)
            {
                $this->session->set('flashMsg', 'Error: Title is required! ');
                return $this->app->redirect(
                    $this->router->url('tree-php/0')
                );
            }

            $try = $this->TreePhpEntity->update([
                'title' => $title,
                'modified_by' => $this->user->get('id'),
                'modified_at' => date('Y-m-d H:i:s'),
                'id' => $ids,
            ]);
            
            if($try)
            {
                $structure = json_decode($structure, true);
                $removes = json_decode($removes, true);
                foreach($removes as $item)
                {
                    $find = $this->TreeStructureEntity->findOne(['note_id = '. $item, 'diagram_id = '. $ids ]);
                    if ($find)
                    {
                        $this->TreeStructureEntity->remove($find['id']);
                    }
                }

                foreach($structure as $item)
                {
                    $find = $this->TreeStructureEntity->findOne(['note_id = '. $item['id'], 'diagram_id = '. $ids ]);
                    if ($find)
                    {
                        $try = $this->TreeStructureEntity->update([
                            'id' => $find['id'],
                            'tree_position' => $item['id'] ? $item['position'] : 0,
                            'tree_level' => $item['id'] ? $item['level'] : 0,
                            'parent_id' => $item['id'] ? $item['parent'] : 0,
                        ]);
                    }else{
                        $try = $this->TreeStructureEntity->add([
                            'diagram_id' => $ids,
                            'note_id' => $item['id'],
                            'tree_position' => $item['id'] ? $item['position'] : 0,
                            'tree_level' => $item['id'] ? $item['level'] : 0,
                            'parent_id' => $item['id'] ? $item['parent'] : 0,
                            'tree_left' => 0,
                            'tree_right' => 0,
                        ]);
                    }
                }
                $try = $this->TreeStructureEntity->rebuild($ids);
                if (!$try)
                {
                    $msg = 'Error: Save Structure Fail!';
                    $this->session->set('flashMsg', $msg);
                    return $this->app->redirect(
                        $this->router->url('tree-php/'. $ids)
                    );
                }
                $this->session->set('flashMsg', 'Updated successfully');
                $link = $save_close ? 'tree-phps' : 'tree-php/'. $ids;
                return $this->app->redirect(
                    $this->router->url($link)
                );
            }
            else
            {
                $msg = 'Error: Updated failed';
                $this->session->set('flashMsg', $msg);
                return $this->app->redirect(
                    $this->router->url('tree-php/'. $ids)
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
                if( $this->TreePhpModel->remove( $id ) )
                {
                    $count++;
                }
            }
        }
        elseif( is_numeric($ids) )
        {
            if( $this->TreePhpModel->remove($ids ) )
            {
                $count++;
            }
        }


        $this->session->set('flashMsg', $count.' deleted record(s)');
        return $this->app->redirect(
            $this->router->url('tree-phps'),
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
                $this->router->url('tree-phps'),
            );
        }

        return $id;
    }
}
