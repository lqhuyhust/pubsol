<?php
/**
 * SPT software - homeController
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 *
 */

namespace App\plugins\note2_attachment\controllers;

use SPT\Response;
use DTM\note2\libraries\NoteController;

class ajax extends NoteController
{
    public function list()
    {
        $urlVars = $this->request->get('urlVars');
        $id = isset($urlVars['id']) ? $urlVars['id'] : 0;

        $list = $this->NoteAttachmentModel->attachmentOfNote($id);
        $this->app->set('format', 'json');
        $this->set('list', $list);
        return ;
    }

    public function add()
    {
        $urlVars = $this->request->get('urlVars');
        $id = isset($urlVars['id']) ? $urlVars['id'] : 0;
        $files = $this->request->file->get('file', [], 'array');
        $try = $this->NoteAttachmentModel->add($files, $id);
        
        $status = $try ? 'done' : 'failed';
        $msg = $try ? 'Upload Done' : 'Error: '. $this->NoteAttachmentModel->getError();
        
        $this->app->set('format', 'json');
        $this->set('status', $status);
        $this->set('message', $msg);
        return ;
    }

    public function delete()
    {
        $urlVars = $this->request->get('urlVars');
        $id = isset($urlVars['id']) ? $urlVars['id'] : 0;

        $try = $this->NoteAttachmentModel->remove($id);
        $status = $try ? 'done' : 'failed';
        $msg = $try ? 'Remove Done' : 'Error: '. $this->NoteAttachmentModel->getError();
        
        $this->app->set('format', 'json');
        $this->set('status', $status);
        $this->set('message', $msg);
        return ;

    }
}