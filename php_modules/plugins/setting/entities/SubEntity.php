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

class SubEntity extends Entity
{
    protected $table = '#__subject'; //table name
    protected $pk = 'sub_id'; //primary key

    public function getFields()
    {
        return [
            // write your code here
            'sub_id' => [
                'type' => 'int',
                'pk' => 1,
                'option' => 'unsigned',
                'extra' => 'auto_increment',
            ],
            'sub_active' => [
                'type' => 'enum',
                'limit' => "'Y', 'N'",
                'default_value' => 'Y',
            ],
            'sub_name' => [
                'type' => 'varchar',
                'limit' => 200,
                'default_value' => '',
            ],
            'sub_search' => [
                'type' => 'varchar',
                'limit' => 255,
                'default_value' => '',
            ],
            'sub_img' => [
                'type' => 'varchar',
                'limit' => 50,
                'default_value' => 'None',
            ],
            'sub_hdr_img' => [
                'type' => 'varchar',
                'limit' => 30,
                'default_value' => 'None',
            ],
            'sub_text' => [
                'type' => 'text',
            ],
            'sub_resource' => [
                'type' => 'text',
            ],
            'sub_citation' => [
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