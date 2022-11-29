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

class SubImageEntity extends Entity
{
    protected $table = '#__subject_image'; //table name
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
                'option' => 'unsigned',
            ],
            'sort_order' => [
                'type' => 'int',
                'default_value' => '1',
                'option' => 'unsigned',
            ],
            'info_text' => [
                'type' => 'varchar',
                'limit' => 255,
            ],
            'info_image' => [
                'type' => 'varchar',
                'limit' => 80,
            ],
            'info_sound' => [
                'type' => 'varchar',
                'limit' => 80,
            ],
        ];
    }

    public function remove_bulks( $id, $field = '' )
    {   
        if( empty($field) ) $field = $this->pk;
        return $this->db->table( $this->table )->delete([ $field => $ids]);
    }
}