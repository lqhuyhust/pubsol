<?php namespace App\plugins\milestone\controllers;

use SPT\Web\ControllerMVVM;
use SPT\Response;

class Note extends ControllerMVVM 
{
    public function getNote()
    {
        $urlVars = $this->request->get('urlVars');
        $request_id = (int) $urlVars['request_id'];

        $search = trim($this->request->post->get('search', '', 'post'));
        
        $relate_note = $this->RelateNoteEntity->list(0, 0, ['request_id = '. $request_id]);
        $where = [];
        if ($relate_note)
        {
            foreach ($relate_note as $note)
            {
                $where[] = 'id <> '. $note['note_id'];
            }
        }
        if ($search)
        {
            $where[] = "title like '%". $search ."%'";
        }
        $notes = $this->NoteEntity->list(0 , 0, $where);
        $this->app->set('format', 'json');
        $this->set('result', $notes);
        return ;
    }

    public function add()
    {
        $request_id = $this->validateRequestID();
        $notes = $this->request->post->get('note_id', [], 'array');
        
        $try = $this->RelateNoteModel->addNote($notes, $request_id);
        if( !$try )
        {
            $this->app->set('format', 'json');
            $this->set('result', 'fail');
            $this->set('message', 'Error: Create Relate Note Failed!');
            return ;
        }
        else
        {
            $this->app->set('format', 'json');
            $this->set('result', 'ok');
            $this->set('message', 'Create Relate Note Successfully!');
            return ;
        }
    }

    public function delete()
    {
        $ids = $this->validateID();
        $request_id = $this->validateRequestID();

        $count = 0;
        if( is_array($ids))
        {
            foreach($ids as $id)
            {
                //Delete file in source
                if( $this->RelateNoteModel->remove( $id ) )
                {
                    $count++;
                }
            }
        }
        elseif( is_numeric($ids) )
        {
            if( $this->RelateNoteModel->remove($ids ) )
            {
                $count++;
            }
        }  
        
        $this->app->set('format', 'json');
        $this->set('result', 'ok');
        $this->set('message', $count.' deleted record(s)');
        return ;
    }

    public function validateID()
    {
        $request_id = $this->validateRequestID();
        $urlVars = $this->request->get('urlVars');
        $id = isset($urlVars['id']) ? (int) $urlVars['id'] : 0;

        if(empty($id))
        {
            $ids = $this->request->post->get('ids', [], 'array');
            if(count($ids)) return $ids;

            $this->session->set('flashMsg', 'Invalid Relate Note');
            return $this->app->redirect(
                $this->router->url('detail-request/'. $request_id),
            );
        }

        return $id;
    }

    public function validateRequestID()
    {
        
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['request_id'];

        if(empty($id))
        {
            $this->session->set('flashMsg', 'Invalid Request');
            return $this->app->redirect(
                $this->router->url('admin'),
            );
        }

        return $id;
    }
}