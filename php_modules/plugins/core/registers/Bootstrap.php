<?php
namespace App\plugins\core\registers;

use SPT\Query;
use SPT\Response;
use SPT\Application\IApp;
use SPT\Extend\Pdo as PdoWrapper;
use App\plugins\core\libraries\Token;
use SPT\Session\Instance as Session;
use SPT\Session\PhpSession;
use SPT\Session\DatabaseSession;
use SPT\Session\DatabaseSessionEntity;

class Bootstrap
{
    public static function initialize( IApp $app)
    {
        // do something to register with system
        // register database
        static::prepareDB($app);
        static::prepareToken($app);
        static::prepareSession($app);
        static::prepareResponse($app);
    }

    public static function prepareDB(IApp $app)
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

    public static function prepareToken(IApp $app)
    {
        $container = $app->getContainer();
        $token = new Token($app);
        $container->set('token', $token);
    }
    
    public static function prepareResponse(IApp $app)
    {
        $container = $app->getContainer();
        $response = new Response();
        $container->set('response', $response);
    }

    public static function prepareSession(IApp $app)
    {
        $container = $app->getContainer();
        $query = $container->get('query');
        $token = $container->get('token');

        $session = new Session(
            $container->exists('query') ? 
            new DatabaseSession( new DatabaseSessionEntity($query), $token->getToken() ) :
            new PhpSession()
        );

        $container->set('session', $session);
    }
}