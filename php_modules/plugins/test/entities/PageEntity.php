<?php
/**
 * SPT software - Entity
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic entity
 * 
 */

namespace App\plugins\test\entities;

use SPT\Storage\DB\Entity;

class PageEntity extends Entity
{
    protected $table = '#__cms_pages';
    protected $pk = 'id';

    public function getFields()
    {
        return [
                'id' => [
                    'type' => 'int',
                    'pk' => 1,
                    'option' => 'unsigned',
                    'extra' => 'auto_increment',
                ],
                'template_id' => [
                    'type' => 'int',
                ],
                'title' => [
                    'type' => 'varchar',
                    'limit' => 255,
                ],
                'slug' => [
                    'type' => 'varchar',
                    'limit' => 255,
                ],
                'settings' => [
                    'type' => 'text'
                ],
                'permission' => [
                    'type' => 'text'
                ],
                'created_at' => [
                    'type' => 'datetime' 
                ],
                'created_by' => [
                    'type' => 'int',
                    'option' => 'unsigned',
                ],
                'locked_at' => [
                    'type' => 'datetime' 
                ],
                'locked_by' => [
                    'type' => 'int',
                    'option' => 'unsigned',
                ],
        ];
    }
}