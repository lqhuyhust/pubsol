<?php
/**
 * SPT software - Note controller
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: note controller
 *
 */

namespace App\plugins\note2\libraries;

use SPT\Application\IApp;
use SPT\Container\Client as Base;
use SPT\Support\Filter;
use App\plugins\note2\libraries\INoteController;
use App\plugins\note2\libraries\NoteDispatch;
use App\plugins\note2\libraries\Note;

class NoteDispatch extends Base
{
    public function execute()
    {
        $cName = $this->app->get('controller');
        $fName = $this->app->get('function');

        $loadChildPlugin = $this->app->get('loadChildPlugin', false);
        $loadChildPlugin ? $this->childProcess($cName, $fName) : $this->process($cName, $fName);
    }

    private function process($cName, $fName)
    {
        $controller = 'App\plugins\note2\controllers\\'. $cName;
        if(!class_exists($controller))
        {
            $this->app->raiseError('Invalid controller '. $cName);
        }

        $controller = new $controller($this->getContainer());
        $controller->{$fName}();
        
        $this->app->set('theme', $this->app->cf('adminTheme'));

        $fName = 'to'. ucfirst($this->app->get('format', 'html'));

        $this->app->finalize(
            $controller->{$fName}()
        );
    }

    private function childProcess($cName, $fName)
    {
        // prepare note
        $urlVars = $this->app->rq('urlVars');
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
            $row = $this->Note2Entity->findByPK($urlVars['id']);
            // TODO: use Note2Entity
            $notetype = $row['type']; 
        }

        // to avoid empty notetype, let set default

        $class = '';

        $noteTypes = $this->Note2Model->getTypes();

        if(empty($noteTypes[$notetype]) )
        {
            $this->app->raiseError('Invalid Note type '.$notetype);
        }
        else
        {
            $class = $noteTypes[$notetype]['namespace'];
        } 

        $this->app->set('noteType', $notetype);

        // set plugin info
        $plgName = $this->app->get('mainPlugin');
        $plgName = $plgName['name'].'_'.$notetype;

        $controller = $class. 'controllers\\'. $cName;
        if(!class_exists($controller))
        {
            $this->app->raiseError('Invalid controller '. $cName);
        }

        $controller = new $controller($this->getContainer());
        
        if(!($controller instanceof INoteController))
        {
            $this->app->raiseError('Prohibited controller '. $cName);
        }
        
        $controller->{$fName}();
        $controller->setCurrentPlugin($plgName);
        $this->app->set('theme', $this->app->cf('adminTheme'));

        $fName = 'to'. ucfirst($this->app->get('format', 'html'));

        $this->app->finalize(
            $controller->{$fName}()
        );
    }
}