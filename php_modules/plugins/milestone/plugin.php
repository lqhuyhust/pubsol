<?php
/**
 * SPT software - Stater plugin
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic plugin
 * 
 */

namespace App\plugins\milestone;

use SPT\App\Instance as AppIns;
use SPT\Plugin\CMS as PluginAbstract;
use SPT\Support\Loader;
use Joomla\DI\Container;

class plugin extends PluginAbstract
{ 
    public function register()
    {
        return [
            // write your code here
            'viewmodels' => [
                'alias' => [
                    'App\plugins\milestone\viewmodels\AdminMilestonesVM' => 'AdminMilestonesVM',
                    'App\plugins\milestone\viewmodels\AdminMilestoneVM' => 'AdminMilestoneVM',
                ],
            ],
            'models' => [
                'alias' => [
                    'App\plugins\milestone\models\MilestoneModel' => 'MilestoneModel',
                ],
            ],
            'entity' => [],
        ];
    }

    public function getInfo()
    {
        return [
            'name' => 'milestone',
            'author' => 'Pham Minh',
            'version' =>  '0.1',
            'description' => 'Milestone Plugin'
        ];
    }

    public function loadEntity(Container $container)
    {
        $path = AppIns::path('plugin'). 'milestone/entities';
        $namespace = 'App\plugins\milestone\entities';
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
            // else { debug this }
        }
    }

    public function registerMenu()
    {
        return [
            [['milestones', 'milestone',], 'milestones', 'Milestones', '<i class="fa-solid fa-business-time"></i>', ''],
        ];
    }
}
