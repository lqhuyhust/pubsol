<?php
namespace App\plugins\note2\registers;

use SPT\Application\IApp;
use SPT\Support\Filter;
use App\plugins\note2\libraries\INoteController;

class Dispatcher
{
    public static function dispatch(IApp $app)
    {
        // $app->plgLoad('permission', 'CheckSession'); 

        // prepare note
        $urlVars = $app->rq('urlVars');
        $notetype = '';

        // todo check public_id
        if(isset($urlVars['type']) && !isset($urlVars['id']))
        {
            $notetype = Filter::cmd($urlVars['type']);
        }
        elseif( isset($urlVars['id']) )
        {
            // TODO: verify note exist
            // TODO: setup note data
           $row = $container->Note2Entity->findByPk();
           // $notetype =  ..
        }

        // to avoid empty notetype, let set it as default

        $class = '';
        $app->childLoad('notetype', 'registerType', function($types) use ($notetype, &$class) {
            
            if(isset($types[$notetype]))
            {
                $class = $types[$notetype];
            }
        });

        if(empty($class) )
        {
            $app->raiseError('Invalid Note type '.$notetype);
        }

        if(is_array($class))
        {
            // TODO: solve more attached info
        }

        $app->set('noteType', $notetype);

        $container = $app->getContainer();
        $cName = $app->get('controller');
        $fName = $app->get('function');

        $controller = $class. 'controllers\\'. $cName;
        
        if(!class_exists($controller))
        {
            $app->raiseError('Invalid controller '. $cName);
        }

        $controller = new $controller($app->getContainer());
        
        if(!($controller instanceof INoteController))
        {
            $app->raiseError('Prohibited controller '. $cName);
        }

        $controller->{$fName}();

        $fName = 'to'. ucfirst($app->get('format', 'html'));

        $app->finalize(
            $controller->{$fName}()
        );
    }
}