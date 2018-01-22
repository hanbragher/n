<?php

$routes =  [
	"test" => [
		'method'    => "GET",
		'view'      => ROOT."/views/test.php",
		'model'     => ''
	],
	"users" => [
		'method'    => "GET",
		'view'      => ROOT."/views/users.php",
		'model'     => 'User@getAll'
	],
	"error" => [
		'method' => "GET",
		'view'      => ROOT."/views/error.php",
	],
	"saveuserform" => [
		'method'    => "GET",
		'view'      => ROOT."/views/saveuserform.php",
	],
	"saveuser" => [
		'method'    => "POST",
		'model'     => 'User@saveUser',
		'redirect'  => "users"
	]
];

return $routes;