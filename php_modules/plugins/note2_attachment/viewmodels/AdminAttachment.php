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
            ],
        ];
    }
    
    private function attachments($layoutData, $viewData)
    {
        $id = $viewData['id'] ? $viewData['id'] : 0;
        $this->NoteAttachmentModel->getData($id);

        return $data;
    }
}
