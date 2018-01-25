<?php

class User
{
    private $username;
    private $pass;
    private $mail;
    private $checks;

    public function set($a, $b){
        $this->$a = $b;
    }

    public function get($a){
        return $this->$a;
    }

    public function randnumber10(){
        $rnd;
        for ($a = 0; $a <= 9; $a++){
            $rnd .= rand(0, 9);
        };
        $this->checks = $rnd;
    }

    private function  regpashesh($regpswrd){
        $rpashesh = password_hash($regpswrd, PASSWORD_DEFAULT);
        $this->pass = $rpashesh;
    }

    /*function __construct($regpswrd, $mailvalue)
    {
       // $this->username = $uservalue;
        $this->regpashesh($regpswrd);
        $this->mail = $mailvalue;
        $this->randnumber10("checks");
    }*/
}