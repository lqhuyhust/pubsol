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

use SPT\Web\MVVM\ControllerContainer as Controller;

class Version extends Controller 
{
    public function rollback()
    {
        $id = $this->validateID();
        $version = $this->NoteHistoryEntity->findByPK($id);
        if ($version)
        {
            $data = json_decode($version['meta_data'], true);
            $data['id'] = $version['note_id'];
            $try = $this->NoteEntity->update($data);
            if ($try)
            {
                $this->session->set('flashMsg', 'Update Successfully');
                $remove = $this->NoteHistoryEntity->list(0, 0, ['id > '.$id, 'note_id = '. $version['note_id']]);
                foreach($remove as $item)
                {
                    $this->NoteHistoryEntity->remove($item['id']);
                }

                return $this->app->redirect(
                    $this->router->url('note/'. $data['id'])
                );
            }
        }

        $this->session->set('flashMsg', 'Error: Update Fail');
        return $this->app->redirect(
            $this->router->url('note/'. $data['id'])
        );
    }

    public function detail()
    {
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];

        $exist = $this->NoteHistoryEntity->findByPK($id);

        if(!empty($id) && !$exist)
        {
            $this->session->set('flashMsg', "Invalid note");
            return $this->app->redirect(
                $this->router->url('notes')
            );
        }

        $this->app->set('layout', 'backend.note_history.form');
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
    }

    public function delete()
    {
        $ids = $this->validateID();

        $count = 0;
        if( is_numeric($ids) )
        {
            $version = $this->NoteHistoryEntity->findByPK($ids);
            $link = $version ? $this->router->url('note/'. $version['note_id']) : $this->router->url('notes');
            if( $this->NoteHistoryEntity->remove($ids ) )
            {
                $count++;
            }
        }


        $this->session->set('flashMsg', $count.' deleted record(s)');
        return $this->app->redirect(
            $link
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

            $this->session->set('flashMsg', 'Invalid version');
            return $this->app->redirect(
                $this->router->url('notes'),
            );
        }

        return $id;
    }
}