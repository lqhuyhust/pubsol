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

use SPT\Web\MVVM\ControllerContainer as Controller;
use SPT\Response;

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

        $this->app->set('format', 'json');
        $this->set('result', $result);
        return ;
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
                
                $this->app->set('format', 'json');
                $this->set('result', 'ok');
                $this->set('message', 'Update Successfully');
                $this->set('description', $document['description']);
                return ;
            }
            
        }

        $this->app->set('format', 'json');
        $this->set('result', 'fail');
        $this->set('message', 'Update Failed');
        return ;
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
        
        $this->app->set('format', 'json');
        $this->set('result', 'ok');
        $this->set('message', $count.' deleted record(s)');
        return ;
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