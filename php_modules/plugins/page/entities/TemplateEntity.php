<?php
/**
 * SPT software - Entity
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic entity
 * 
 */

namespace App\plugins\page\entities;

use SPT\Storage\DB\Entity;

class TemplateEntity extends Entity
{
    protected $table = '#__cms_templates';
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
                'fnc' => [
                    'type' => 'varchar',
                    'limit' => 255,
                ],
                'title' => [
                    'type' => 'varchar',
                    'limit' => 255,
                ],
                'note' => [
                    'type' => 'varchar',
                    'limit' => 255
                ],
                'positions' => [
                    'type' => 'text' 
                ],
                'path' => [
                    'type' => 'text' 
                ],
                'status' => [
                    'type' => 'int',
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