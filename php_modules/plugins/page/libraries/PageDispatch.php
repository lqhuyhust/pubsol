<?php
/**
 * SPT software - Page dispatch
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Page dispatch
 *
 */

namespace App\plugins\page\libraries;

use SPT\Application\IApp;
use SPT\Container\Client as Base;
use SPT\Support\Filter;

class PageDispatch extends Base
{
    public function execute()
    {
        $cName = $this->app->get('controller');
        $fName = $this->app->get('function');

        $loadChildPlugin = $this->app->get('loadChildPlugin', false);
        $loadChildPluginType = $this->app->get('loadChildPluginType', false);
        if ($loadChildPluginType)
        {
            return $this->childTypeProcess($cName, $fName);
        }
        $loadChildPlugin ? $this->childProcess($cName, $fName) : $this->process($cName, $fName);
    }

    private function process($cName, $fName)
    {
        $controller = 'App\plugins\page\controllers\\'. $cName;
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
        $slug = $this->router->get('actualPath');
        $slug = trim($slug, '/'); 

        $currentPage = $this->PageModel->getCurrentPage($slug);
        if (!$currentPage)
        {
            $this->app->raiseError('Invalid Request', 500);
        }
        
        $this->app->set('object', $currentPage);
        
        $class = $currentPage['type']['namespace'];
        $try = $currentPage['type']['fnc'];
        $try = explode('.', $try);

        list($plgName, $cName, $fName) = $try;

        $controller = $class. $cName;
        if(!class_exists($controller))
        {
            $this->app->raiseError('Invalid controller '. $cName);
        }

        $controller = new $controller($this->getContainer());
        
        $controller->{$fName}();
        $controller->setCurrentPlugin($plgName);
        $controller->set('widgetPosition', $currentPage['widgetPosition']);

        $fName = 'to'. ucfirst($this->app->get('format', 'html'));

        $this->app->finalize(
            $controller->{$fName}()
        );
    }

    private function childTypeProcess($cName, $fName)
    {
        // prepare page
        $urlVars = $this->app->rq('urlVars');
        $pagetype = '';

        // todo check public_id
        if(isset($urlVars['type']) && !isset($urlVars['id']))
        {
            $pagetype = Filter::cmd($urlVars['type']);
        }
        elseif( isset($urlVars['id']) )
        {
            $row = $this->PageEntity->findByPK($urlVars['id']);
            $pagetype = $row['page_type']; 
        }

        // to avoid empty pagetype, let set default

        $class = '';

        $pagetypes = $this->PageModel->getTypes();

        if(empty($pagetypes[$pagetype]) )
        {
            $this->app->raiseError('Invalid Page type '.$pagetype);
        }
        else
        {
            $class = $pagetypes[$pagetype]['namespace'];
        } 

        $this->app->set('pagetype', $pagetype);

        // set plugin info
        $plgName = $this->app->get('mainPlugin');
        $plgName = $plgName['name'].'_'.$pagetype;

        $controller = $class. 'controllers\\'. $cName;
        if(!class_exists($controller))
        {
            $this->app->raiseError('Invalid controller '. $cName);
        }

        $controller = new $controller($this->getContainer());
        
        $controller->{$fName}();
        $controller->setCurrentPlugin($plgName);
        $this->app->set('theme', $this->app->cf('adminTheme'));

        $fName = 'to'. ucfirst($this->app->get('format', 'html'));

        $this->app->finalize(
            $controller->{$fName}()
        );
    }
}