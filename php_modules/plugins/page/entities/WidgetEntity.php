<?php
/**
 * SPT software - Entity
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic entity
 * 
 */

namespace App\plugins\page\entities;

use SPT\Storage\DB\Entity;

class WidgetEntity extends Entity
{
    protected $table = '#__cms_widgets';
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
                'title' => [
                    'type' => 'varchar',
                    'limit' => 255,
                ],
                'settings' => [
                    'type' => 'text'
                ],
                'template_id' => [
                    'type' => 'int'
                ],
                'position_name' => [
                    'type' => 'varchar',
                    'limit' => 255,
                ],
                'widget_type' => [
                    'type' => 'varchar',
                    'limit' => 255,
                ],
                'created_at' => [
                    'type' => 'datetime' 
                ],
                'created_by' => [
                    'type' => 'int',
                    'option' => 'unsigned',
                ],
                'locked_at' => [
                    'type' => 'datetime' 
                ],
                'locked_by' => [
                    'type' => 'int',
                    'option' => 'unsigned',
                ],
        ];
    }

    public function removeByTemplate($id)
    {
        $try = $this->db->table( $this->table )->delete([ 'template_id' => $id]);
        return $try;
    }
}