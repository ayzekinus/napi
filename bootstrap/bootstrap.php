<?php

require_once 'app/config.php';


define('BASE_FOLDER', $config['folder']);
define('ADMIN_FOLDER', $config['admin']);
define('MODE', $config['mode']);
define('IP', $_SERVER['REMOTE_ADDR']);
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . (BASE_FOLDER == '' ? '' : '/' . BASE_FOLDER));
define('APP_KEY', $config['key']);

switch (MODE) {
    case 'debug': error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
        break;
    case 'live': error_reporting(0);
        break;
    default: die('The application environment is not set correctly. Please check config file.');
}

date_default_timezone_set($config['timezone']);


require_once 'bootstrap/route.php';
require_once 'bootstrap/controller.php';
require_once 'bootstrap/load.php';
require_once 'bootstrap/autoload.php';
require_once 'bootstrap/database.php';
require_once 'bootstrap/sql.php';
require_once 'bootstrap/errorf.php';
require_once 'bootstrap/url.php';


Route::getInstance();
require_once 'app/routes.php';
Route::run();