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

class TopSubEntity extends Entity
{
    protected $table = '#__top_sub'; //table name

    public function getFields()
    {
        return [
            // write your code here
            'topic_id' => [
                'type' => 'int',
                'option' => 'unsigned',
            ],
            'subject_id' => [
                'type' => 'int',
                'option' => 'unsigned',
            ],
        ];
    }

    public function listSub( $start, $limit, $topic_id, array $where = [], $order = '', $select = 'subject.* , top_sub.*')
    {
        $list = $this->db->select( $select )->table( $this->table )->join('INNER JOIN #__subject ON top_sub.topic_id="' . $topic_id . '" and top_sub.subject_id=subject.sub_id');

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

    public function listTopic( $start, $limit, $sub_id, array $where = [], $order = 'topic_name', $select = 'topic.* , top_sub.*')
    {
        $list = $this->db->select( $select )->table( $this->table )->join('INNER JOIN #__topic ON top_sub.subject_id="' . $sub_id . '" and top_sub.topic_id=topic.topic_id');
        $list->groupby('top_sub.topic_id');
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

    public function remove( $topic_id, $sub_id = '' )
    {   
        return $this->db->table( $this->table )->delete( ['topic_id' => $topic_id, 'subject_id' => $sub_id ] );
    }

    public function remove_bulks( $id, $field = '' )
    {   
        if( empty($field) ) $field = $this->pk;
        return $this->db->table( $this->table )->delete([ $field => $ids]);
    }
}