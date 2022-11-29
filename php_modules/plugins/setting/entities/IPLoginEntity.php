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

class IPLoginEntity extends Entity
{
    protected $table = '#__ip_login'; //table name
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
            'u_id' => [
                'type' => 'int',
                'option' => 'unsigned',
                'null' => 'yes',
            ],
            'ip_addr' => [
                'type' => 'varchar',
                'limit' => 16,
            ],
        ];
    }

    public function remove_bulks( $id, $field = '' )
    {   
        if( empty($field) ) $field = $this->pk;
        return $this->db->table( $this->table )->delete([ $field => $ids]);
    }
}