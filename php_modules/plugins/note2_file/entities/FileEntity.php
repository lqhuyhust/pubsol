<?php
/**
 * SPT software - Entity
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic entity
 * 
 */

namespace App\plugins\note2_xml\entities;

use SPT\Storage\DB\Entity;

class FileEntity extends Entity
{
    protected $table = '#__note2_file';
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
                'note_id' => [
                    'type' => 'int',
                    'option' => 'unsigned'
                ],
                'path' => [
                    'type' => 'text'
                ],
                'type' => [
                    'type' => 'varchar',
                    'limit' => 45,
                ]/*
                'uploaded_at' => [
                    'type' => 'datetime',
                    'null' => 'YES',
                ],
                'uploaded_by' => [
                    'type' => 'int',
                    'option' => 'unsigned',
                ]*/
        ];
    }
}