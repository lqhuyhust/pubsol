<?php
/**
 * SPT software - Demo application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: How we start an MVC
 * 
 */

define('ROOT_PATH', __DIR__ . '/../');
define('APP_PATH', ROOT_PATH. 'php_modules/');
define('PUBLIC_PATH', __DIR__ . '/');
define('MEDIA_PATH', PUBLIC_PATH. 'media/');
define('SPT_STORAGE_PATH', PUBLIC_PATH);

require ROOT_PATH. 'vendor/autoload.php';

$app = new SPT\Application\Web(
    new \SPT\Container\Joomla,
    PUBLIC_PATH,
    APP_PATH. 'plugins',
    APP_PATH. 'config.php',
    'App'
);

$app->execute(APP_PATH. 'themes');
