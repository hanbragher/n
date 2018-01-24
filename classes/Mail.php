<?php
/**
 * Created by PhpStorm.
 * User: Sevak
 * Date: 23.01.2018
 * Time: 19:43
 */

class Mail {

	public static function send($to, $subject, $message, $headers=null){
		mail($to, $subject, $message, $headers);
	}
}