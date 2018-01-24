<?php

class CheckUser extends User
{
    private $DB;
    private $responce;


    function __construct()
    {

        //$this->set("DB", mysqli_connect('localhost', "root", '', 'userbaza'));
        $this->set("mail", $_POST["regmail"]);
        $this->set("pass", $_POST["regpswrd"]);


    }

    public function check()
    {
        if ($this->get("mail")) {
            if ($this->get("pass")) {
                $value = "SELECT passwrd, stat, alive  FROM users WHERE mail='" . $this->get("mail") . "'";
                $user = mysqli_query($this->get("DB"), $value);
                $user = mysqli_fetch_assoc($user);
                if (password_verify($this->get("pass"),$user['passwrd'])){
                    if($user['alive'] == 1){
                        if($user['stat']==1){
                            $this->set('responce',
                                ["success" => true,
                                 "message" => ""]);
                        }else{
                            $this->set('responce',
                                ["success" => false,
                                "message" => "Օգտատիրոջ մուտքը հաստատված չէ"]);}
                    }else{
                        $this->set('responce',
                            ["success" => false,
                            "message" => "Օգտատերը հեռացված է"]);}
                }else{
                    $this->set('responce',
                        ["success" => false,
                        "message" => "Սխալ տվյալներ"]);}

            }
        }
       return $this->responce;
    }



}