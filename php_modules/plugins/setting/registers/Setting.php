<?php
namespace App\plugins\setting\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Setting
{
    public static function registerItem( IApp $app )
    {
        return [
            'System' => [
                'admin_mail' => [
                    'text',
                    'label' => 'Admin Mail:',
                    'formClass' => 'form-control',
                ],
                'email_host' => [
                    'text',
                    'label' => 'Email Host:',
                    'formClass' => 'form-control',
                ],
                'email_port' => [
                    'text',
                    'label' => 'Email Port:',
                    'formClass' => 'form-control',
                ],
                'email_username' => [
                    'email',
                    'label' => 'Email:',
                    'formClass' => 'form-control',
                ],
                'email_password' => [
                    'password',
                    'label' => 'Password Email:',
                    'formClass' => 'form-control',
                ],
                'email_from_addr' => [
                    'email',
                    'label' => 'From Email:',
                    'formClass' => 'form-control',
                ],
                'email_from_name' => [
                    'text',
                    'label' => 'From Name:',
                    'formClass' => 'form-control',
                ],
            ],
        ];
    }
}