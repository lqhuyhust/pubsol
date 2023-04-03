<?php
/**
 * SPT software - Entity
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic entity
 * 
 */

namespace App\plugins\note\entities;

use SPT\Storage\DB\Entity;

class NoteDiagramEntity extends Entity
{
    protected $table = '#__note_diagrams';
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
                'title' => [
                    'type' => 'varchar',
                    'limit' => 255,
                ],
                'notes' => [
                    'type' => 'text',
                    'null' => 'YES',
                ],
                'config' => [
                    'type' => 'longtext',
                    'null' => 'YES',
                ],
                'created_at' => [
                    'type' => 'datetime',
                    'null' => 'YES',
                ],
                'created_by' => [
                    'type' => 'int',
                    'option' => 'unsigned',
                ],
                'modified_at' => [
                    'type' => 'datetime',
                    'null' => 'YES',
                ],
                'modified_by' => [
                    'type' => 'int',
                    'option' => 'unsigned',
                ],
        ];
    }
}