<?php
ini_set('memory_limit', '-1');

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));
defined('ROOT_PATH')
    || define('ROOT_PATH', realpath(dirname(__FILE__) . ''));

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(ROOT_PATH),
    get_include_path(),
)));
date_default_timezone_set('Europe/Malta');
error_reporting(E_ALL);

function asd($arr, $doNotDie = false)
{
	echo "<pre>";
	print_r($arr);
	if(!$doNotDie)
		die;
}
/** Zend_Application */
require_once 'Zend/Application.php';
// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()
            ->run();