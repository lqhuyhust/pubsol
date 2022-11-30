<?php
/**
 * SPT software - Entity
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic entity
 * 
 */

namespace App\plugins\starter\entities;

use SPT\Storage\DB\Entity;

class StarterEntity extends Entity
{
    protected $table = ''; //table name
    protected $pk = ''; //primary key

    public function getFields()
    {
        return [
            // write your code here
        ];
    }
}