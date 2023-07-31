<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\report_timeline\models;

use SPT\Container\Client as Base;
use SPT\Traits\ErrorString;

class TimelineModel extends Base
{ 
    use ErrorString; 

    public function remove($id)
    {
        // remove in tree structure
        if (!$id)
        {
            return false;
        }

        $try = $this->ReportEntity->remove($id);
        return $try;
    }

    public function validate($data)
    {
        if (!$data || !is_array($data))
        {
            $this->error = 'Invalid data format';
            return false;
        }

        if (!$data['title'])
        {
            $this->error = "title can't empry";
            return false;
        }

        return $data;
    }

    public function add($data)
    {
        $try = $this->validate($data);
        if (!$try)
        {
            return false;
        }

        $newId =  $this->ReportEntity->add([
            'title' => $data['title'],
            'status' => 1,
            'data' => json_encode([
                'milestone' => $data['milestone'] ? $data['milestone'] : [],
                'tags' => $data['tags'] ? $data['tags'] : [],
            ]),
            'type' => 'timeline',
            'created_by' => $this->user->get('id'),
            'created_at' => date('Y-m-d H:i:s'),
            'modified_by' => $this->user->get('id'),
            'modified_at' => date('Y-m-d H:i:s')
        ]);

        if (!$newId)
        {
            $this->error = "Can't create report";
        }

        return $newId;
    }

    public function update($data)
    {
        $try = $this->validate($data);
        if (!$try || !$data['id'])
        {
            return false;
        }

        $try = $this->ReportEntity->update([
            'title' => $data['title'],
            'data' => json_encode([
                'milestone' => $data['milestone'] ? $data['milestone'] : [],
                'tags' => $data['tags'] ? $data['tags'] : [],
            ]),
            'modified_by' => $this->user->get('id'),
            'modified_at' => date('Y-m-d H:i:s'),
            'id' => $data['id'],
        ]);

        if (!$try)
        {
            $this->error = "Can't update report";
        }

        return $try;
    }

    public function getDetail($id)
    {
        if (!$id)
        {
            $this->error = 'Invalid id';
            return false;
        }

        $find = $this->ReportEntity->findByPK($id);
        if (!$find)
        {
            $this->error = 'Invalid report';
            return false;
        }

        $data = $find['data'];
        $data = $data ? json_decode($data, true) : [];

        $data['milestone'] = $data ? $data['milestone'] : [];
        $data['tags'] = $data ? $data['tags'] : [];

        return $find;
    }

    public function getRangeDay($where = [])
    {
        $where[10] = 'start_at IS NOT NULL && start_at > 0';
        $start = $this->query->table('#__requests')->detail($where, 'UNIX_TIMESTAMP(MIN(start_at)) as minstart, UNIX_TIMESTAMP(MAX(start_at)) as maxstart');

        $where[10] = 'finished_at IS NOT NULL';
        $finish = $this->query->table('#__requests')->detail($where, 'UNIX_TIMESTAMP(MAX(finished_at)) as maxfinish, UNIX_TIMESTAMP(NOW() - INTERVAL 3 DAY) as minstart, UNIX_TIMESTAMP(NOW() + INTERVAL 3 DAY) as maxstart');
        
        return [
            min($start['minstart'], $finish['minstart']),
            max($start['maxstart'],  $finish['maxfinish']) // $finish['maxstart'],
        ];
    }
}
