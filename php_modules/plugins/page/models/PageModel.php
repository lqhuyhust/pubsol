<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\page\models;

use SPT\Container\Client as Base;
use SPT\Traits\ErrorString;

class PageModel extends Base
{ 
    use ErrorString; 

    private $types;
    public function getPageTypes()
    {
        if(null === $this->types)
        {
            $types = [];
            $this->app->childLoad('Pagetype', 'registerType', function($items) use (&$types) {
                $types += $items;
            });

            $this->types = $types;
        }
        return $this->types;
    }

    public function setTemplate($path)
    {
        if (!$path)
        {
            return false;
        }

        $path = explode('/', $path);
        if (count($path) != 2)
        {
            return false;
        }
        list($theme, $page) = $path;
        
        $this->app->set('theme', $theme);
        $this->app->set('page', $page);
        return true;
    }
    // Write your code here
    public function remove($id)
    {
        if (!$id)
        {
            return false;
        }

        return $this->PageEntity->remove($id);
    }

    public function validate($data)
    {
        if (!$data || !is_array($data))
        {
            return false;
        }

        if (!$data['title'])
        {
            $this->error = 'Error: Title can\'t empty! ';
            return false;
        }

        if ($data['slug'])
        {
            $where = ['slug' => $data['slug']];
            if (isset($data['id']))
            {
                $where[] = 'id <> '.$data['id'];
            }

            $find = $this->PageEntity->findOne($where);
            if ($find)
            {
                $this->error = 'Error: Slug already used! ';
                return false;
            }
        }

        return $data;
    }

    public function add($data)
    {
        $try = $this->validate($data);
        if (!$try)
        {
            return false;
        }

        if(!$data['slug'])
        {
            $data['slug'] = $this->generateSlug($data['title']);
        }

        $newId =  $this->PageEntity->add([
            'title' => $data['title'],
            'template_id' => $data['template_id'],
            'slug' => $data['slug'],
            'permission' => '',
            'page_type' => $data['page_type'],
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->user->get('id'),
            'locked_at' => date('Y-m-d H:i:s'),
            'locked_by' => $this->user->get('id'),
        ]);

        return $newId;
    }

    public function update($data)
    {
        $try = $this->validate($data);
        if (!$try || !isset($data['id']) || !$data['id'])
        {
            return false;
        }

        $try = $this->PageEntity->update([
            'title' => $data['title'],
            'template_id' => $data['template_id'],
            'slug' => $data['slug'],
            'permission' => '',
            'page_type' => $data['page_type'],
            'id' => $data['id'],
        ]);

        return $try;
    }

    public function generateSlug($text, $id = 0)
    {
        if (!$text)
        {
            return false;
        }

        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate divider
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        // check duplicate
        $done = false;
        $index = 0;
        $slug_tmp = $text;
        while($done == false)
        {
            $where = ['slug' => $slug_tmp];
            if ($id)
            {
                $where['id'] = $id;
            }
            $findOne = $this->PageEntity->findOne($where);
            if ($findOne)
            {
                $index++;
                $slug_tmp = $text . '-'. $index;
            }
            else
            {
                $done = true;
            }
        }

        return $index ? $text . '-'. $index : $text;
    }

    public function getCurrentPage(string $slug)
    {   
        $page = $this->PageEntity->findOne(['slug' => $slug]);
        if (!$page) return false;

        $types = $this->getPageTypes();
        if (empty($types[$page['page_type']]) ) return false;

        $page['type'] = $types[$page['page_type']];

        $template = $this->TemplateEntity->findByPK($page['template_id']);
        $page['template'] = $template ? $template['path'] : '';
        $this->setTemplate($page['template']); 

        $widgetPosition = $this->TemplateModel->getWidgetPosition($page['template_id']);
        $page['widgetPosition'] = $widgetPosition ? $widgetPosition : [];

        return $page;
    }
}
