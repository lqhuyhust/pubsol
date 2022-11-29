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

class TopicEntity extends Entity
{
    protected $table = '#__topic'; //table name
    protected $pk = 'topic_id'; //primary key

    public function getFields()
    {
        return [
            // write your code here
            'topic_id' => [
                'type' => 'int',
                'pk' => 1,
                'option' => 'unsigned',
                'extra' => 'auto_increment',
            ],
            'topic_name' => [
                'type' => 'varchar',
                'limit' => 70,
                'default_value' => '',
            ],
            'topic_active' => [
                'type' => 'enum',
                'limit' => "'Y', 'N'",
                'default_value' => 'N',
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