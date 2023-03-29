<?php
/**
 * SPT software - Demo application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: How we start an MVC
 * 
 */

define( 'APP_PATH', __DIR__ . '/../');
define('PUBLIC_PATH', __DIR__ . '/');
define('MEDIA_PATH', PUBLIC_PATH. 'media/');
define('SPT_PATH_TEMP', PUBLIC_PATH);

require APP_PATH. 'vendor/autoload.php';

$app = new SPT\Application\Joomla\Web(
    APP_PATH. 'php_modules/plugins',
    APP_PATH. 'php_modules/config.php',
    'App'
);

$app->execute(APP_PATH. 'php_modules/themes');
