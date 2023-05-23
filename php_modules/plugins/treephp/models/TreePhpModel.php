<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\treephp\models;

use SPT\JDIContainer\Base; 

class TreePhpModel extends Base
{ 
    // Write your code here
    public function getTree($id)
    {
        $list = $this->TreeStructureEntity->list(0, 0, ['diagram_id ='.$id], 'tree_left asc');
        $removes = [];
        foreach($list as &$item)
        {
            if (in_array($item['id'], $removes))
            {
                $this->TreeStructureEntity->remove($item['id']);
                continue;
            }

            $note = $this->NoteEntity->findByPK($item['note_id']);
            if (!$note)
            {
                $removes[] = $item['id'];
                $this->TreeStructureEntity->remove($item['id']);
            }
            else
            {
                $item['title'] = $note['title'];
            }
        }

        if ($removes)
        {
            $this->TreeStructureEntity->rebuild($id);
            $list = $this->getTree($id);
        }
        
        return $list;
    }

    public function findNotes($config)
    {
        $notes = [];
        foreach($config as $key => &$item)
        {
            if ($item['id'])
            {
                $notes[] = $item['id'];
            }

            if (isset($item['children']) && $item['children'])
            {
                $notes = array_merge($notes, $this->findNotes($item['children']) ) ;
            }
        }

        return $notes;
    }

    public function remove($id)
    {
        // remove in tree structure
        $list = $this->TreeStructureEntity->list(0, 0, ['diagram_id = '. $id]);
        
        foreach($list as $item)
        {
            $this->TreeStructureEntity->remove($item);
        }

        $try = $this->DiagramEntity->remove($id);
        return $try;
    }
}
