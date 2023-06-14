<?php
/**
 * SPT software - homeController
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 *
 */

namespace App\plugins\note\controllers;

use SPT\Web\ControllerMVVM;
use SPT\Response;

class Note extends ControllerMVVM
{
    public function detail()
    {
        
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];

        $exist = $this->NoteEntity->findByPK($id);

        if(!empty($id) && !$exist)
        {
            $this->session->set('flashMsg', "Invalid note");
            return $this->app->redirect(
                $this->router->url('notes')
            );
        }
        $this->app->set('layout', 'backend.note.form');
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
    }

    public function preview()
    {
        
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];

        $exist = $this->NoteEntity->findByPK($id);

        if(!$exist)
        {
            $this->session->set('flashMsg', "Invalid note");
            return $this->app->redirect(
                $this->router->url('notes')
            );
        }
        $this->app->set('layout', 'backend.note.preview');
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
    }


    public function list()
    {
                $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.note.list');
    }

    public function add()
    {
        //check title sprint
        $data = [
            'title' => $this->request->post->get('title', '', 'string'),
            'tags' => $this->request->post->get('tags', '', 'string'),
            'description' => $this->request->post->get('description', '', 'string'),
            'description_sheetjs' => $this->request->post->get('description_sheetjs', '', 'string'),
            'description_presenter' => $this->request->post->get('description_presenter', '', 'string'),
            'files' => $this->request->file->get('files', [], 'array'),
            'note' => $this->request->post->get('note', '', 'string'),
            'type' => $this->request->post->get('type', 'html', 'string'),
        ];
        
        $save_close = $this->request->post->get('save_close', '', 'string');
        

        if (!$this->NoteModel->validate($data))
        {
            return $this->app->redirect(
                $this->router->url('note/0')
            );
        }
        
        $newId = $this->NoteModel->add($data);

        $msg = $newId ? 'Created Successfully!': 'Error: Created Failed!';
        $this->session->set('flashMsg', $msg);
        if ($newId)
        {
            $link = $save_close ? 'notes' : 'note/'. $newId;
        }
        else
        {
            $link = 'note/0';
        }

        return $this->app->redirect(
            $this->router->url($link)
        );
        
    }

    public function update()
    {
        $ids = $this->validateID();

        // TODO valid the request input

        if(is_numeric($ids) && $ids)
        {
            $data = [
                'title' => $this->request->post->get('title', '', 'string'),
                'tags' => $this->request->post->get('tags', '', 'string'),
                'description' => $this->request->post->get('description', '', 'string'),
                'description_sheetjs' => $this->request->post->get('description_sheetjs', '', 'string'),
                'description_presenter' => $this->request->post->get('description_presenter', '', 'string'),
                'files' => $this->request->file->get('files', [], 'array'),
                'note' => $this->request->post->get('note', '', 'string'),
                'type' => $this->request->post->get('type', 'html', 'string'),
                'id' => $ids,
            ];

            $save_close = $this->request->post->get('save_close', '', 'string');

            if (!$this->NoteModel->validate($data))
            {
                return $this->app->redirect(
                    $this->router->url('note/'. $ids)
                );
            }
            
            $try = $this->NoteModel->update($data);
            
            if($try)
            {
                $this->session->set('flashMsg', 'Updated successfully');
                $link = $save_close ? 'notes' : 'note/'. $ids;

                return $this->app->redirect(
                    $this->router->url($link)
                );
            }
            else
            {
                $msg = 'Error: Updated failed';
                $this->session->set('flashMsg', $msg);
                return $this->app->redirect(
                    $this->router->url('note/'. $ids)
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
                if( $this->NoteModel->remove( $id ) )
                {
                    $count++;
                }
            }
        }
        elseif( is_numeric($ids) )
        {
            if( $this->NoteModel->remove($ids ) )
            {
                $count++;
            }
        }


        $this->session->set('flashMsg', $count.' deleted record(s)');
        return $this->app->redirect(
            $this->router->url('notes'),
        );
    }

    public function validateID()
    {
        
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];

        if(empty($id))
        {
            $ids = $this->request->post->get('ids', [], 'array');
            if(count($ids)) return $ids;

            $this->session->set('flashMsg', 'Invalid note');
            return $this->app->redirect(
                $this->router->url('notes'),
            );
        }

        return $id;
    }

    public function search()
    {
        if (!$this->user->get('id'))
        {
            $this->app->set('format', 'json');
            $this->set('status' , 'fail');
            $this->set('data' , $this->user->get('id'));
            $this->set('message' , 'You are not allow.');
            return true;
        }

        $search = trim($this->request->get->get('search', '', 'string'));
        $ignore = $this->request->get->get('ignore', '', 'string');

        $where = [];
        if ($search)
        {
            $tags = $this->TagEntity->list(0, 0, ["`name` LIKE '%" . $search . "%' "]);
            $where[] = "(`note` LIKE '%" . $search . "%')";
            $where[] = "(`title` LIKE '%" . $search . "%')";
            if ($tags) {
                foreach ($tags as $tag) {
                    $where[] = "(`tags` = '" . $tag['id'] . "'" .
                        " OR `tags` LIKE '%" . ',' . $tag['id'] . "'" .
                        " OR `tags` LIKE '" . $tag['id'] . ',' . "%'" .
                        " OR `tags` LIKE '%" . ',' . $tag['id'] . ',' . "%' )";
                }
            }
            $where = ['('. implode(" OR ", $where). ')'];
        }

        if ($ignore)
        {
            $where[] = 'id NOT IN('.$ignore.')';
        }

        $result = $this->NoteEntity->list(0, 0, $where, '`title` asc');
        $result = $result ? $result : [];

        $this->app->set('format', 'json');
        $this->set('status' , 'success');
        $this->set('data' , $result);
        $this->set('message' , '');
        return;
    }

    public function request()
    {
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];
        if (!$id || !$this->user->get('id'))
        {
            $this->app->set('format', 'json');
            $this->set('status' , 'fail');
            $this->set('data' , $this->user->get('id'));
            $this->set('message' , 'You are not allow.');
            return;
        }
        $list = $this->RelateNoteEntity->list(0, 0, ['note_id = '. $id]);
        $result = [];
        foreach($list as &$item)
        {
            $request = $this->RequestEntity->findByPK($item['request_id']);
            if ($request)
            {
                $request['start_at'] = $request['start_at'] && $request['start_at'] != '0000-00-00 00:00:00' ? date('m-d-Y', strtotime($request['start_at'])) : '';
                $request['finished_at'] = $request['finished_at'] && $request['finished_at'] != '0000-00-00 00:00:00' ? date('m-d-Y', strtotime($request['finished_at'])) : '';
                $result[] = $request;
            }
        }
        
        $this->app->set('format', 'json');
        $this->set('status' , 'success');
        $this->set('data' , $result);
        $this->set('message' , '');
        return;
    }
}