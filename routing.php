<?php
$routing =  [
	"/reg" => [
		'method'    => 'GET',
		'view'      => ROOT."/views/reg_form.php",
		'model'     => ''
	],
	"/error" => [
		'method'    => 'GET',
		'view'      => ROOT."/views/error_page.html",
		'model'     => ''
	],
	"/" => [
		'method'    => 'GET',
		'view'      => ROOT."/views/login_form.php",
		'model'     => ''
	],
];

return $routing;