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
    public function getVersion()
    {
        $version_x = $this->OptionModel->get('version_format_x', 'x');
        $version_y = $this->OptionModel->get('version_format_y', 'y');
        $version_z = $this->OptionModel->get('version_format_z', 'z');

        $version_lastest = $this->VersionEntity->list(0, 1, [], 'id desc');
        $current_version = $version_lastest ? $version_lastest[0]['version'] : '';
        
        $vParts = explode('.', $current_version);
        $maxMajor = (int) str_repeat('9', substr_count('x', $version_x));
        $maxMinor = (int) str_repeat('9', substr_count('x', $version_y));
        $maxPatch = (int) str_repeat('9', substr_count('x', $version_z));

        $partsArray = [
            'major' => $vParts[0],
            'minor' => $vParts[1],
            'patch' => $vParts[2],
        ];
        $partsArray['patch'] = $partsArray['patch'] + 1;
        if ($partsArray['patch'] > $maxPatch) {
            $partsArray['minor'] = $partsArray['minor'] + 1;
            $partsArray['patch'] = 0;
        }
        if ($partsArray['minor'] > $maxMinor) {
            $partsArray['major'] = $partsArray['major'] + 1;
            $partsArray['minor'] = 0;
        }

        $version_number = implode( ".", $partsArray );

        return $version_number;
    }

}
