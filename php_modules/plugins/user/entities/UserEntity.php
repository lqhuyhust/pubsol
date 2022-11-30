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

use SPT\User\SPT\UserEntity as Entity;

class UserEntity extends Entity
{
    protected $table = '#__users';
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
                'name' => [
                    'type' => 'varchar',
                    'limit' => 100,
                ],
                'username' => [
                    'type' => 'varchar',
                    'limit' => 100,
                ],
                'password' => [
                    // 'validate' => ['md5'],
                    'type' => 'varchar',
                    'limit' => 255,
                ],
                'email' => [
                    'type' => 'varchar',
                    'limit' => 255,
                ],
                'status' => [
                    'type' => 'tinyint',
                ],
                'created_at' => [
                    'type' => 'datetime',
                    'null' => 'YES',
                ],
                'created_by' => [
                    'type' => 'int',
                    'option' => 'unsigned',
                ],
                'modified_at' => [
                    'type' => 'datetime',
                    'null' => 'YES',
                ],
                'modified_by' => [
                    'type' => 'int',
                    'option' => 'unsigned',
                ],
        ];
    }
}