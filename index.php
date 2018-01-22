<?php
include ('functions.php');
//

$routing = include ('routing.php');
$adress = ($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI']:"/";
$method = $_SERVER['REQUEST_METHOD'];


if($routing[$adress]){
		if($method == $routing [$adress]['method']){
			include ($routing[$adress]['view']);
		}
	}else{
		header ('Location: /error');}


//include ('views/login_form.php');
//print_r($_SERVER);
