<?php
namespace App\plugins\report\registers;

use SPT\Application\IApp;
use SPT\Response;
use App\plugins\report\libraries\ReportDispatch;

class Dispatcher
{
    public static function dispatch(IApp $app)
    {
        $reportDispatcher = new ReportDispatch($app->getContainer());
        $reportDispatcher->execute();
    }
}