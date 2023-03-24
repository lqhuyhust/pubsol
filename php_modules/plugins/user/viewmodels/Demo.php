<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a core view
 * 
 */

namespace App\plugins\user\viewmodels;

use SPT\Web\user\ViewModel;

class Demo extends ViewModel
{
    public static function register()
    {
        return [
            'layouts.home'
        ];
    }

    public function home()
    {
        return [
            'user_var' => 'ViewModel is great!'
        ];
    }
}