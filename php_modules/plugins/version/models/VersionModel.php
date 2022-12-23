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
        $version_y = $this->OptionModel->get('version_format_y', 'x');
        $version_z = $this->OptionModel->get('version_format_z', 'x');

        $version_lastest = $this->VersionEntity->list(0, 1, [], 'id desc');
        $current_version = $version_lastest ? $version_lastest[0]['version'] : '';
        
        $vParts = explode('.', $current_version);
        $maxMajor = (int) str_repeat('9', substr_count($version_x, 'x'));
        $maxMinor = (int) str_repeat('9', substr_count($version_y, 'x'));
        $maxPatch = (int) str_repeat('9', substr_count($version_z, 'x'));

        $partsArray = [
            'major' => $vParts[0],
            'minor' => $vParts[1],
            'patch' => isset($vParts[2]) ? $vParts[2] : '',
        ];
        if ($version_z)
        {
            $partsArray['patch'] = $partsArray['patch'] + 1;
        }
        else
        {
            unset($partsArray['patch']);
            $partsArray['minor'] = $partsArray['minor'] + 1;
        }
        if ($version_z && $partsArray['patch'] > $maxPatch) {
            $partsArray['minor'] = $partsArray['minor'] + 1;
            $partsArray['patch'] = 0;
        }
        if ($partsArray['minor'] > $maxMinor) {
            $partsArray['major'] = $partsArray['major'] + 1;
            $partsArray['minor'] = 0;
        }

        if (substr_count($version_x, 'x') - strlen((string) $partsArray['minor']))
        {
            $partsArray['minor'] = str_repeat('0', substr_count($version_x, 'x') - strlen((string) $partsArray['minor'])) . $partsArray['minor'];
        }

        if (substr_count($version_y, 'x') - strlen((string) $partsArray['major']))
        {
            $partsArray['major'] = str_repeat('0', substr_count($version_y, 'x') - strlen((string) $partsArray['major'])) . $partsArray['major'];
        }

        if ($version_z && substr_count($version_z, 'x') - strlen((string) $partsArray['patch']))
        {
            $partsArray['patch'] = str_repeat('0', substr_count($version_z, 'x') - strlen((string) $partsArray['patch'])) . $partsArray['patch'];
        }
        $version_number = implode( ".", $partsArray );

        return $version_number;
    }

}
