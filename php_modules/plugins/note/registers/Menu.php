<?php
namespace App\plugins\note\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Menu
{
    public static function registerMenu( IApp $app )
    {
        $container = $app->getContainer();
        $menu_root = $container->exists('menu') ? $container->get('menu') : [];

        $menu = [
            [['notes', 'note',], 'notes', 'Notes', '<i class="fa-solid fa-clipboard"></i>', '', ''],
            [['note-diagrams', 'note-diagram',], 'note-diagrams', 'Note Diagrams', '<i class="fa-solid fa-diagram-project"></i>', '', ''],
        ];
        $menu_root[1] = isset($menu_root[1]) ? array_merge($menu_root[1], $menu) : $menu;
        $container->set('menu', $menu_root);
    }
}