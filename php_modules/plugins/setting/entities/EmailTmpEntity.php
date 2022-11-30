<?php
/**
 * SPT software - Entity
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic entity
 * 
 */

namespace App\plugins\setting\entities;

use SPT\Storage\DB\Entity;

class EmailTmpEntity extends Entity
{
    protected $table = '#__email_tmp'; //table name
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
            'e_name' => [
                'type' => 'varchar',
                'limit' => 250,
            ],
            'e_sub' => [
                'type' => 'varchar',
                'limit' => 250,
            ],
            'e_tmp' => [
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