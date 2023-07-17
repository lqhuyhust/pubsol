<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\note2_attachment\viewmodels;

use SPT\Web\ViewModel;
use SPT\Web\Gui\Form;

class AdminAttachment extends ViewModel
{
    public static function register()
    {
        return [
            'widget'=>[
                'backend.attachments',
                'backend.javascript',
            ],
        ];
    }
    
    public function attachments($layoutData, $viewData)
    {
        $id = $viewData['id'] ? $viewData['id'] : 0;
        $attachments = $this->NoteAttachmentModel->getDetail($id);
        
        return [
            'attachments' => $attachments,
        ];
    }

    public function javascript($layoutData, $viewData)
    {
        $id = isset($viewData['id']) ? $viewData['id'] : 0; 
        return [
            'link_attachment' => $this->router->url('note2/attachment/' . $id),
            'link_attachment_remove' => $this->router->url('note2/attachment/delete'),
        ];
    }
}
