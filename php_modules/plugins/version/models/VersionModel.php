<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\version\models;

use SPT\JDIContainer\Base; 

class VersionModel extends Base 
{ 
    public function version()
    {
        $where = [];
        $result = $this->VersionEntity->list(0, 0, $where, '');
        if($result) {
            foreach($result as $item){
                $record [] = $item['id'];
            }
            $max_id = max($record);
            $where = [
                'id = '. $max_id
            ];
        }
        $result = $this->VersionEntity->list(0, 0, $where, '');
        foreach($result as $item){}

        $current_version = $item['version'];
        if($current_version == '')
        {
            $current_version = '0.0.0';
        }
        $vParts = explode('.', $current_version);
        $partsArray = [
            'major' => $vParts[0],
            'minor' => $vParts[1],
            'patch' => $vParts[2],
        ];
        $partsArray['patch'] = $partsArray['patch'] + 1;
        if ($partsArray['patch'] > 99) {
            $partsArray['minor'] = $partsArray['minor'] + 1;
            $partsArray['patch'] = 0;
        }
        if ($partsArray['minor'] > 99) {
            $partsArray['major'] = $partsArray['major'] + 1;
            $partsArray['minor'] = 0;
        }

        $vArray = implode( ".", $partsArray );

        return $vArray;
    }

}
