<?php
define ('ROOT', __DIR__);

spl_autoload_register(function ($class) {
	include (ROOT."/classes/". $class .".php");
});


$routing = include ('routing.php');
$adress = ($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI']:"/";
$method = $_SERVER['REQUEST_METHOD'];

if($routing[$adress]){
		if($method == $routing [$adress]['method']){
			if ($model = $routing [$adress]['model']){
				$model = explode ('#', $model);
				$className = $model[0];
				$classMethod = $model[1];
				$obj = new $className;
				$data = $obj->$classMethod();
			}
			include ($routing[$adress]['view']);
		}else{
		    header ('Location: /error');};
}else{
    header ('Location: /error');}


//include ('views/login_form.php');
//print_r($_SERVER);
