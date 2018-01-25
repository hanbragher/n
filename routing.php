<?php
$routing =  [
	//baza stexcel

    "/baza" => [
        'method'    => 'GET',
        'view'      => ROOT."/actions/one_time_mysql_action.php",
        'model'     => ''
    ],

    "login" => [
        'method'    => 'GET',
        'view'      => ROOT."/views/userview.php",
        'model'     => 'CheckUser#check'
    ],

    "trylogin" => [
        'method'    => 'POST',
        'view'      => ROOT."/views/userview.php",
        'model'     => 'CheckUser#check'
    ],

    "reg" => [
		'method'    => 'POST',
		'view'      => ROOT."/views/reg_form.php",
		'model'     => 'NewUser#grancelUser'
	],


    "registration" => [
		'method'    => 'GET',
		'view'      => ROOT."/views/reg_form.php",
		'model'     => ''
	],

    "activation" => [
            'method'    => 'GET',
            'view'      => ROOT."/actions/account_activation.php",
            'model'     => 'NewUser#activation',
	        'params'    => ["mail", "key"]
    ],

    "agree" => [
		'method'    => 'GET',
		'view'      => ROOT."/views/hamadzayanagir.html",
		'model'     => ''
	],

	"error" => [
		'method'    => 'GET',
		'view'      => ROOT."/views/error_page.php",
		'model'     => ''
	],

    "userview" => [
        'method'    => 'POST',
        'view'      => ROOT."/views/userview.php",
        'model'     => ''
    ],

	null => [
		'method'    => 'GET',
		'view'      => ROOT."/views/start_page.php",
		'model'     => ''
	],
];
return $routing;