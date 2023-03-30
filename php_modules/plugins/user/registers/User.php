<?php
namespace App\plugins\user\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;
use SPT\User\Instance as UserInstance;
use SPT\User\SPT\User as UserAdapter;
use App\plugins\user\entities\UserEntity;

class User
{
    public static function loadUser( IApp $app )
    {
        $container = $app->getContainer();
        $user = new UserInstance( new UserAdapter() );
        $session = $container->get('session');
        $query = $container->get('query');
        $user->init([
            'session' => $session,
            'entity' => new  UserEntity($query)
        ]);
        $container->share('user', $user, true);
    }
}