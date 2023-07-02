<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\test\models;

use SPT\Container\Client as Base;

class TemplateModel extends Base
{ 
    private $templates;
    public function getTemplatePaths()
    {
        if(null === $this->templates)
        {
            $this->templates = [];
            foreach(new \DirectoryIterator(SPT_THEME_PATH.'../') as $file) 
            {
                if (!$file->isDot() && $file->isDir()) 
                {
                    $template = $file->getBasename();
                    $path = $file->getPath(). '/'.$template;
                    foreach(new \DirectoryIterator( $path ) as $file) 
                    {
                        if (!$file->isDot() && $file->isFile() && $file->getExtension() == 'php') 
                        {
                            $basename = $file->getBasename('.php');
                            $json = $path. '/'. $basename. '.json'; 
                            if(file_exists($json))
                            {
                                $this->templates[$template.'/'. $basename] = [
                                    $template,
                                    $basename,
                                    json_decode(file_get_contents($json) )
                                ];
                            }
                        }
                    }
                }
            }
        }
        return $this->templates;
    } 

    // Write your code here
    public function remove($id)
    {
        $where = [
            "(`templates` = '" . $id . "'" .
            " OR `templates` LIKE '%" . ',' . $id . "'" .
            " OR `templates` LIKE '" . $id . ',' . "%'" .
            " OR `templates` LIKE '%" . ',' . $id . ',' . "%' )"
        ];

        //find note
        $list_note = $this->NoteEntity->list(0, 0, $where);
        foreach($list_note as $note)
        {
            $templates = $note['templates'] ? explode(',', $note['templates']) : [];
            $key = array_search($id, $templates);
            unset($templates[$key]);
            $this->NoteEntity->update([
                'templates' => implode(',', $templates),
                'id' => $note['id'],
            ]);
        }

        //find Request
        $list_request = $this->RequestEntity->list(0, 0, $where);
        foreach($list_request as $request)
        {
            $templates = $request['templates'] ? explode(',', $request['templates']) : [];
            $key = array_search($id, $templates);
            unset($templates[$key]);
            $this->RequestEntity->update([
                'templates' => implode(',', $templates),
                'id' => $request['id'],
            ]);
        }

        return $this->TemplateEntity->remove($id);
    }

    public function validate($data)
    {
        if (!$data || !is_array($data))
        {
            return false;
        }

        if (!$data['name'])
        {
            $this->session->set('flashMsg', 'Error: Name can\'t empty! ');
            return false;
        }

        $where = ['name' => $name];
        if (isset($data['id']) && $data['id'])
        {
            $where[] = 'id <> '. $data['id'];
        }

        $findOne = $this->TemplateEntity->findOne($where);
        if ($findOne)
        {
            $this->session->set('flashMsg', 'Error: Create Failed! Template already exists');
            return false;
        }

        return $data;
    }

    public function add($data)
    {
        if (!$data || !is_array($data))
        {
            return false;
        }

        $newId =  $this->TemplateEntity->add([
            'name' => $data['name'],
            'description' => $data['description'],
            'parent_id' => $data['parent_id'],
        ]);

        return $newId;
    }

    public function update($data)
    {
        if (!$data || !is_array($data) || !$data['id'])
        {
            return false;
        }

        $try = $this->TemplateEntity->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'parent_id' => $data['parent_id'],
            'id' => $data['id'],
        ]);

        return $try;
    }

    public function search($search, $ignores)
    {
        $where = [];

        if( !empty($search) )
        {
            $where[] = "(`name` LIKE '%".$search."%' )";
        }

        if ($ignores && is_array($ignores))
        {
            $where[] = "id NOT IN (". implode(',', $ignores).")";
        }

        $data = $this->TemplateEntity->list(0,100, $where);
        foreach($data as &$item)
        {
            if ($item['parent_id'])
            {
                $tmp = $this->TemplateEntity->findByPK($item['parent_id']);
                if ($tmp)
                {
                    $item['name'] = $tmp['name']. ' > '. $item['name'];
                }
            }
        }

        return $data;
    }
}
