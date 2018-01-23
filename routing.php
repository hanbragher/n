<?php
$routing =  [
	//baza stexcel

    "/baza" => [
        'method'    => 'GET',
        'view'      => ROOT."/actions/one_time_mysql_action.php",
        'model'     => ''
    ],

    "/login" => [
        'method'    => 'POST',
        'view'      => ROOT."/views/login_form.php",
        'model'     => ''
    ],


    "/reg" => [
		'method'    => 'POST',
		'view'      => ROOT."/views/reg_form.php",
		'model'     => ''
	],

    "/registration" => [
		'method'    => 'POST',
		'view'      => ROOT."/actions/registration.php",
		'model'     => ''
	],

    "/agree" => [
		'method'    => 'GET',
		'view'      => ROOT."/views/hamadzayanagir.html",
		'model'     => ''
	],

	"/error" => [
		'method'    => 'GET',
		'view'      => ROOT."/views/error_page.php",
		'model'     => ''
	],

    "/userview" => [
        'method'    => 'POST',
        'view'      => ROOT."/views/userview.php",
        'model'     => ''
    ],

	"/" => [
		'method'    => 'GET',
		'view'      => ROOT."/views/start_page.php",
		'model'     => ''
	],
];
return $routing;