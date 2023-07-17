<?php
/**
 * SPT software - Entity
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic entity
 * 
 */

namespace App\plugins\note2_file\entities;

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
                'file_type' => [
                    'type' => 'varchar',
                    'limit' => 45,
                ]
        ];
    }

    public function list( $start, $limit, array $where = [], $order = '', $select = '*')
    {
        $list = $this->db->select( 'notes.*, note_files.note_id as note_id, note_files.path as path, note_files.file_type as file_type' )
                            ->table( $this->table . ' as note_files' )
                            ->join('INNER JOIN #__note2 as notes ON notes.id = note_files.note_id');
        if( count($where) )
        {
            $list->where( $where );
        }

        if($order)
        {
            $list->orderby($order);
        }

        return $list->countTotal(true)->list( $start, $limit);
    }
}