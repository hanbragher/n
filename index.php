<?php
define ('ROOT', __DIR__);
define ('SITE', "http://n");

spl_autoload_register(function ($class) {
	include (ROOT."/classes/". $class .".php");
});


$routing = include ('routing.php');
$path = ($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI']:"/";
$method = $_SERVER['REQUEST_METHOD'];
$path_params = array_filter(explode('/', $path));

$adress = array_shift($path_params);

if($routing[$adress]){
		if($method == $routing [$adress]['method']){
			if ($model = $routing [$adress]['model']){
				$model = explode ('#', $model);
				$className = $model[0];
				$classMethod = $model[1];
				$obj = new $className;
				$params = [];
				if ($paramArray = $routing [$adress]['params']){
					foreach ($paramArray as $key=>$paramName){
						$params[$paramName] = $path_params[$key];
					}
				}
				$data = $obj->$classMethod($params);
			}
			include ($routing[$adress]['view']);
		}else{
		    header ('Location: /error');};
}else{
    header ('Location: /error');}


//include ('views/login_form.php');
//print_r($_SERVER);
