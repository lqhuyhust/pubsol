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

class SubFactEntity extends Entity
{
    protected $table = '#__subject_fact'; //table name
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
            'subject_id' => [
                'type' => 'int',
                'default_value' => '0',
            ],
            'sort_order' => [
                'type' => 'int',
                'default_value' => '1',
            ],
            'name' => [
                'type' => 'varchar',
                'limit' => 80,
            ],
            'value' => [
                'type' => 'varchar',
                'limit' => 255,
                'null' => 'yes',
            ],
            's_link_id' => [
                'type' => 'int',
                'option' => 'unsigned',
            ],
        ];
    }

    public function remove_bulks( $id, $field = '' )
    {   
        if( empty($field) ) $field = $this->pk;
        return $this->db->table( $this->table )->delete([ $field => $ids]);
    }
}