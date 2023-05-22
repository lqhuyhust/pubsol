<?php
namespace App\plugins\googleauth\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Setting
{
    public static function registerItem( IApp $app )
    {
        return[
            'Google Auth' => [
                'api_secret_key' => [
                    'text',
                    'label' => 'API Secret Key:',
                    'formClass' => 'form-control',
                ],
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