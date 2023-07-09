<?php
/**
 * SPT software - Note controller
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: note controller
 *
 */

namespace App\plugins\page\libraries;

use SPT\Application\IApp;
use SPT\Container\Client as Base;

class PageDispatch extends Base
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
        // prepare note
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
}