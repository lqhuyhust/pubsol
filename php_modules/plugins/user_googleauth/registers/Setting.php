<?php
namespace DTM\plugins\user_googleauth\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Setting
{
    public static function registerItem( IApp $app )
    {
        return[
            'Google Auth' => [
                'google_client_id' => [
                    'text',
                    'label' => 'Google Client ID:',
                    'formClass' => 'form-control',
                ],
                'google_client_secrect' => [
                    'text',
                    'label' => 'Google Client Secrect',
                    'formClass' => 'form-control',
                ],
            ]
        ];
    }
}