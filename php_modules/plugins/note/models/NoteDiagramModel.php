<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\note\models;

use SPT\JDIContainer\Base; 

class NoteDiagramModel extends Base
{ 
    // Write your code here
    public function convertConfig($config)
    {
        foreach($config as $key => &$item)
        {
            $note = $this->NoteEntity->findByPK($item['id']);
            if ($note)
            {
                $item['text'] = $note['title'];
            }
            else{
                unset($config[$key]);
                continue;
            }

            if (isset($item['children']) && $item['children'])
            {
                $item['children'] = $this->convertConfig($item['children']);
            }
        }

        return $config;
    }
}
