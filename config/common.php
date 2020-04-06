<?php

return [
	
	'host' => $_SERVER['HTTP_HOST'],
	'root_url' => 'http://'.$_SERVER['HTTP_HOST'],
	'request_uri' => array_diff(explode('/', strtok(getenv('REQUEST_URI'), '?')), ['']),

	'db' => [
		'host' => 'localhost',
		'dbname' => 'arlekino-event.local',
		'charset' => 'UTF8',
		'pass' => 'root',
		'login' => 'root'
	],

	'rest' => [
		'token' => 'test',
		'email' => 'user@test.ru',
		'pass' => '11111111',
		'username' => 'foo'
	]

];