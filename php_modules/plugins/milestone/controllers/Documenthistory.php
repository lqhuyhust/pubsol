<?php
/**
 * SPT software - homeController
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

namespace App\plugins\milestone\controllers;

use SPT\MVC\JDIContainer\MVController;

class Documenthistory extends Admin 
{
    public function rollback()
    {
        $this->isLoggedIn();
        $request_id = $this->validateRequestID();
        $request = $this->RequestEntity->findByPK($request_id);
        if (!$request)
        {
            $this->session->set('flashMsg', 'Invalid Request');
            return $this->app->redirect(
                $this->router->url('milestones')
            );
        }
        $this->app->set('layout', 'backend.document.form');
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
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
                if( $this->DocumentHistoryEntity->remove( $id ) )
                {
                    $count++;
                }
            }
        }
        elseif( is_numeric($ids) )
        {
            if( $this->DocumentHistoryEntity->remove($ids ) )
            {
                $count++;
            }
        }  
        
        return $this->app->response([
            'result' => 'ok',
            'message' => $count.' deleted record(s)'
        ],200);
    }

    public function validateID()
    {
        $this->isLoggedIn();
        $urlVars = $this->request->get('urlVars');
        $id = isset($urlVars['id']) ? (int) $urlVars['id'] : 0;

        if(empty($id))
        {
            $ids = $this->request->post->get('ids', [], 'array');
            if(count($ids)) return $ids;

            $this->session->set('flashMsg', 'Invalid document');
            return $this->app->redirect(
                $this->router->url(),
            );
        }

        return $id;
    }
}