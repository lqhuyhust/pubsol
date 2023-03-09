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

use SPT\MVC\JDIContainer\MVController;

class Version extends Admin {
    
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
        $this->isLoggedIn();

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