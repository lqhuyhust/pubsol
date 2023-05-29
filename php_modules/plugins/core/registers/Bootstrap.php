<?php
namespace App\plugins\core\registers;

use SPT\Query;
use SPT\Response;
use SPT\Application\IApp;
use SPT\Support\Loader;
use SPT\Extend\Pdo as PdoWrapper;
use App\plugins\core\libraries\Token;
use SPT\Session\Instance as Session;
use SPT\Session\PhpSession;
use SPT\Session\DatabaseSession;
use SPT\Session\DatabaseSessionEntity;
use SPT\User\Instance as UserInstance;
use SPT\User\SPT\User as UserAdapter;
use App\plugins\user\entities\UserEntity;

class Bootstrap
{
    public static function initialize( IApp $app)
    {
        static::prepareDB($app);
        static::prepareSession($app);
        static::loadBasicClasses($app);
        static::prepareUser($app);
        static::prepareTheme($app);
    }

    private static function prepareDB(IApp $app)
    {
        $container = $app->getContainer();
        $config = $container->get('config');
        try{
            $pdo = new PdoWrapper( $config->db );
            if(!$pdo->connected)
            {
                $tmp = $pdo->getLog();
                throw new \Exception('Connection failed. '. $tmp[1], 500); 
            }

            $container->set('query', new Query( $pdo, ['#__'=>  $config->db['prefix']]));
        } 
        catch(\Exception $e) 
        {
            die( $e->getMessage() );
        }
    }

    private static function prepareSession(IApp $app)
    {
        $container = $app->getContainer();
        $query = $container->get('query');
        $token = $container->get('token');

        $session = new Session(
            $container->exists('query') ? 
            new DatabaseSession( new DatabaseSessionEntity($query), $token->value() ) :
            new PhpSession()
        );

        $container->set('session', $session);
    }

    private static function loadBasicClasses(IApp $app)
    {
        $SDMplugins = ['calendar','treephp', 'googleauth', 'milestone','tag', 'note', 'report', 'setting', 'timeline', 'user', 'version'];
        $container = $app->getContainer();
        
        foreach($SDMplugins as $plgName)
        {
            // load entities
            $path = SPT_PLUGIN_PATH. '/'. $plgName. '/entities';
            $namespace = $app->getNamespace().'\\plugins\\'. $plgName. '\entities';
            $inners = Loader::findClass($path, $namespace);
            foreach($inners as $class)
            {
                if(class_exists($class))
                {
                    $entity = new $class($container->get('query'));
                    $entity->checkAvailability();
                    $container->share( $class, $entity, true);
                    $alias = explode('\\', $class);
                    $container->alias( $alias[count($alias) - 1], $class);
                }
            } 

            // load models
            $path = SPT_PLUGIN_PATH. '/'. $plgName. '/models';
            $namespace = $app->getNamespace().'\\plugins\\'.$plgName. '\models';
            $inners = Loader::findClass($path, $namespace);
            foreach($inners as $class)
            {
                if(class_exists($class))
                {
                    $model = new $class($container);
                    $alias = explode('\\', $class);
                    $container->share( $alias[count($alias) - 1], $model, true);
                }
            }
        }
    }
    private static function prepareUser(IApp $app)
    {
        // prepare user
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

    private static function prepareTheme( IApp $app )
    {
        $container = $app->getContainer();
        $config = $container->get('config');
        $request = $container->get('request');

        if(!$config->defaultTheme)
        {
            throw new \Exception('Configuration did not set up theme');
        }
        
        $theme = $request->get('theme', $config->defaultTheme);

        $app->set('theme', $theme);
    }
}