<?php
/**
 * SPT software - Entity
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic entity
 * 
 */

namespace App\plugins\facts4me\entities;

use SPT\Storage\DB\Entity;

class TransEntity extends Entity
{
    protected $table = '#__transactions'; //table name
    protected $pk = 'id'; //primary key

    public function getFields()
    {
        return [
            // write your code here
            'id' => [
                'type' => 'int',
                'pk' => 1,
                'option' => 'unsigned',
                'extra' => 'auto_increment',
            ],
            'userid' => [
                'type' => 'int',
                'option' => 'unsigned',
            ],
            'transid' => [
                'type' => 'longtext',
            ],
            'status' => [
                'type' => 'tinyint',
                'limit' => 1,
                'default_value' => '1',
            ],
            'logs' => [
                'type' => 'text',
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => 'YES',
            ],
            'created_by' => [
                'type' => 'int',
                'null' => 'YES',
            ],
            'modified_at' => [
                'type' => 'datetime',
                'null' => 'YES',
            ],
            'modified_by' => [
                'type' => 'int',
                'null' => 'YES',
            ],
        ];
    }
}