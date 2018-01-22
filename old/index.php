<?php
define('ROOT', __DIR__);


spl_autoload_register(function ($class) {
	$file = ROOT . '/models/' . $class . '.php';
	if(file_exists($file)){
		include $file;
	}else{
		header("Location: /error");
	}
});


$routes = include "routes.php";
$rout =  explode("/", trim( $_SERVER['REQUEST_URI'], "/"))[0];
	$request_method = $_SERVER["REQUEST_METHOD"];

	if ( $routes[ $rout ] ) {
		if ( $method = $routes[ $rout ]['method'] ) {
			if ( $routes[ $rout ]['model'] ) {
				$model     = explode( "@", $routes[ $rout ]['model'] );
				$className = $model[0];
				$method    = $model[1];

				$obj  = new $className();
				$data = $obj->$method();
			}
		}
		if ( $request_method == "GET" ) {
			include( $routes[ $rout ]['view'] );
		} elseif ( $request_method == "POST" ) {
			header( "Location: /" . $routes[ $rout ]['redirect'] );
		}

	} else {
		header( "Location: /error" );
	}