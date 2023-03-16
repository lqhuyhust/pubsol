<?php
/**
 * SPT software - Stater plugin
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic plugin
 * 
 */

namespace App\plugins\note;

use SPT\App\Instance as AppIns;
use SPT\Plugin\CMS as PluginAbstract;
use SPT\Support\Loader;
use Joomla\DI\Container;
use SPT\File;

class plugin extends PluginAbstract
{
    public function register()
    {
        return [
            'viewmodels' => [
                'alias' => [
                    'App\plugins\note\viewmodels\AdminNoteHistoryVM' => 'AdminNoteHistoryVM',
                    'App\plugins\note\viewmodels\AdminNoteVM' => 'AdminNoteVM',
                    'App\plugins\note\viewmodels\AdminNotesVM' => 'AdminNotesVM',
                    'App\plugins\note\viewmodels\AdminNoteDiagramVM' => 'AdminNoteDiagramVM',
                    'App\plugins\note\viewmodels\AdminNoteDiagramsVM' => 'AdminNoteDiagramsVM',
                ],
            ],
            'models' => [
                'alias' => [
                    'App\plugins\note\models\NoteModel' => 'NoteModel',
                    'App\plugins\note\models\AttachmentModel' => 'AttachmentModel',
                ],
            ],
            'entity' => [],
            'file' => [],
            // write your code here
        ];
    }

    public function getInfo()
    {
        return [
            'name' => 'sdm',
            'author' => 'HanhDH',
            'version' =>  '0.1',
            'description' => 'SDM'
        ];
    }

    public function loadFile(Container $container)
    {
        if (!$container->exists('file'))
        {
            $container->set('file', new File());
        }
    }

    public function loadEntity(Container $container)
    {
        $path = AppIns::path('plugin'). 'note/entities';
        $namespace = 'App\plugins\note\entities';
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

    public function registerSetting()
    {
        return [
            [['setting-connections'], 'setting-connections', 'Connections', ''],
        ];
    }

    public function registerMenu()
    {
        return [
            [['notes', 'note',], 'notes', 'Notes', '<i class="fa-solid fa-clipboard"></i>', '', ''],
            [['note-diagrams', 'note-diagram',], 'note-diagrams', 'Note Diagrams', '<i class="fa-solid fa-diagram-project"></i>', '', ''],
        ];
    }
}
