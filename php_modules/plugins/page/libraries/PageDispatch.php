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
        $content_type = '';

        $currentPage = $this->PageModel->getCurrentPage($slug);
        if (!$currentPage)
        {
            $this->app->raiseError('Invalid Request', 500);
        }
        
        $this->app->set('currentPage', $currentPage);

        // TODO: use Note2Entity
        $content_type = $currentPage['content_type']; 

        // to avoid empty notetype, let set default

        $class = '';

        $contentTypes = $this->PageModel->getContentTypes();

        if(empty($contentTypes[$content_type]) )
        {
            $this->app->raiseError('Invalid Page type '.$content_type);
        }
        else
        {
            $class = $contentTypes[$content_type]['namespace'];
        } 

        $this->app->set('content_type', $content_type);

        $try = $contentTypes[$content_type]['fnc'];
        $try = explode('.', $try);
        
        if(count($try) !== 3)
        {
            $this->app->raiseError('Not correct page type', 500);
        }

        list($plgName, $cName, $fName) = $try;

        $controller = $class. $cName;
        if(!class_exists($controller))
        {
            $this->app->raiseError('Invalid controller '. $cName);
        }

        $controller = new $controller($this->getContainer());
        
        $controller->{$fName}();
        $controller->setCurrentPlugin($plgName);

        $fName = 'to'. ucfirst($this->app->get('format', 'html'));

        $this->app->finalize(
            $controller->{$fName}()
        );
    }
}