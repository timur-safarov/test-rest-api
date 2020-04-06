<?php

//Включаем вывод ошибок
error_reporting(E_ALL | E_STRICT);
ini_set('display_startup_errors', 0);
ini_set('display_errors','On');

if (version_compare(phpversion(), '7.0.0', '<') == true) { die('FROM PHP7.0 Only'); }

function __autoload($className) {
	$className = str_replace('\\', '/', $className);
	include $className.'.php';
}

$GLOBALS['config'] = include realpath('./config/common.php');

try {
    libraries\Db::getInstace();
}catch(PDOException $e){
    die($e->getMessage());
}

$request_uri = $GLOBALS['config']['request_uri'];

$nameController = (isset($request_uri['1'])) ? str_replace('-', '', ucwords($request_uri['1'], "-")) : 'Main';

$nameAction = (isset($request_uri['2'])) ? str_replace('-', '', ucwords($request_uri['2'], "-")) : 'Index';

$fileController = 'controllers/'.$nameController.'Controller.php';

$fileControllerApi = 'api/'.$nameController.'.php';

if (file_exists($fileController)) {

	$instanceNameController = 'controllers\\'.$nameController.'Controller';
} else if (file_exists($fileControllerApi)) {

	$instanceNameController = 'api\\'.$nameController;
} else {

	header( 'Location: /');
}

$controller = new $instanceNameController;

if (!in_array($nameAction, get_class_methods($controller))) {
	header( 'Location: /');
}

$controller->$nameAction();

