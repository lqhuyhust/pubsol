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

class Discussion extends Admin 
{
    public function add()
    {
        $this->isLoggedIn();
        $request_id = $this->validateRequestID();
        
        $tmp_check = $this->checkVersion($request_id);
        if($tmp_check) {
            return $this->app->response([
                'result' => 'fail',
                'message' => 'Add Discussion Failed!'
            ],200);
        }

        $document = $this->DocumentEntity->findOne(['request_id = '. $request_id]);
        $message = $this->request->post->get('message', '', 'string');
        if (!$message)
        {
            return $this->app->response([
                'result' => 'fail',
                'message' => 'Message discussion can\'t empty!',
            ], 200);
        }

        if ($document)
        {
            $newId = $this->DiscussionEntity->add([
                'user_id' => $this->user->get('id'),
                'document_id' => $document['id'],
                'message' => $message,
                'sent_at' => date('Y-m-d H:i:s'),
                'modified_at' => date('Y-m-d H:i:s'),
            ]);

            $msg = $newId ? 'Comment Successfully' : 'Comment Fail';
            return $this->app->response([
                'result' => 'ok',
                'message' => $msg,
            ], 200);
        }

        // TODO: validate new add
        $document =  $this->DocumentEntity->add([
            'request_id' => $request_id,
            'description' => '',
            'created_by' => $this->user->get('id'),
            'created_at' => date('Y-m-d H:i:s'),
            'modified_by' => $this->user->get('id'),
            'modified_at' => date('Y-m-d H:i:s')
        ]);
        if (!$document)
        {
            $msg = 'Comment Fail';
            return $this->app->response([
                'result' => 'fail',
                'message' => $msg,
            ], 200);
        }
        
        $newId = $this->DiscussionEntity->add([
            'user_id' => $this->user->get('id'),
            'document_id' => $document,
            'message' => $message,
            'sent_at' => date('Y-m-d H:i:s'),
            'modified_at' => date('Y-m-d H:i:s'),
        ]);

        $msg = $newId ? 'Comment Successfully' : 'Comment Fail';
        return $this->app->response([
            'result' => 'ok',
            'message' => $msg,
        ], 200);

    }

    public function validateRequestID()
    {
        $this->isLoggedIn();

        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['request_id'];

        if(empty($id))
        {
            $this->session->set('flashMsg', 'Invalid Request');
            return $this->app->redirect(
                $this->router->url('milestones'),
            );
        }

        return $id;
    }

    public function checkVersion($request_id)
    {
        $version_lastest = $this->VersionEntity->list(0, 1, [], 'created_at desc');
        $version_lastest = $version_lastest ? $version_lastest[0]['version'] : '0.0.0';
        $tmp_request = $this->RequestEntity->list(0, 0, ['id = '.$request_id], 0);
        foreach($tmp_request as $item) {
        }
        if ($version_lastest > $item['version_id']) {
            return true;
        } else {
            return false;
        }
    }
}