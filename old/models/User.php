<?php
/**
 * Created by PhpStorm.
 * User: Sevak
 * Date: 20.01.2018
 * Time: 18:29
 */

class User {

	private $users = ["user1", "user2", "user3"];

	public function getAll(){
		return $this->users;
	}

	public function saveUser(){
		$this->users[] = "user4";
		return $this->getAll();
	}
}