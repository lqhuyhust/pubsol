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

class Discussion extends Controller 
{
    public function add()
    {
        $request_id = $this->validateRequestID();
        
        $document = $this->DocumentEntity->findOne(['request_id = '. $request_id]);
        $message = $this->request->post->get('message', '', 'string');
        if (!$message)
        {
            $this->app->set('format', 'json');
            $this->set('result', 'fail');
            $this->set('message', 'Message discussion can\'t empty!');
            return;
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
            $this->app->set('format', 'json');
            $this->set('result', 'ok');
            $this->set('message', $msg);
            return;
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
            $this->app->set('format', 'json');
            $this->set('result', 'fail');
            $this->set('message', $msg);
            return ;
        }
        
        $newId = $this->DiscussionEntity->add([
            'user_id' => $this->user->get('id'),
            'document_id' => $document,
            'message' => $message,
            'sent_at' => date('Y-m-d H:i:s'),
            'modified_at' => date('Y-m-d H:i:s'),
        ]);

        $msg = $newId ? 'Comment Successfully' : 'Comment Fail';
        $this->app->set('format', 'json');
        $this->set('result', 'ok');
        $this->set('message', $msg);
        return;

    }

    public function validateRequestID()
    {

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

}