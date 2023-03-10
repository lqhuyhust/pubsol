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
    public function detail()
    {
        $this->isLoggedIn();
        $id = $this->validateID();
        
        $result = '';
        $document = $this->DocumentHistoryEntity->findByPK($id);
        if ($document)
        {
            $result = $document['description'];
        }

        return $this->app->response([
            'result' => $result,
        ],200);
    }

    public function rollback()
    {
        $id = $this->validateID();
        $document = $this->DocumentHistoryEntity->findByPK($id);
        if ($document)
        {
            $try = $this->DocumentEntity->update([
                'id' => $document['document_id'],
                'description' => $document['description'],
            ]);
            if ($try)
            {
                $remove_list = $this->DocumentHistoryEntity->list(0, 0, ['id > '. $id, 'document_id = '. $document['document_id']]);
                if ($remove_list)
                {
                    foreach($remove_list as $item)
                    {
                        $this->DocumentHistoryEntity->remove($item['id']);
                    } 
                }
                
                return $this->app->response([
                    'result' => 'ok',
                    'message' => 'Update Successfully',
                    'description' => $document['description'],
                ],200);
            }
            
        }

        return $this->app->response([
            'result' => 'fail',
            'message' => 'Update Failed'
        ],200);
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