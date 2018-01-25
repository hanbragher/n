<?php

class CheckUser extends User
{
    private $DB;
    private $responce;


    function __construct()
    {

        $this->DB =  mysqli_connect('localhost', "root", '', 'userbaza');
        $this->set("mail", $_POST["mail"]);
        $this->set("pass", $_POST["passwrd"]);


    }

    public function check()
    {
        if ($this->get("mail")) {
            if ($this->get("pass")) {
                $baza = $this->DB;
                $value = "SELECT passwrd, stat, alive  FROM users WHERE mail='" . $this->get("mail") . "'";
                $user = mysqli_query($baza, $value);
                $user = mysqli_fetch_assoc($user);
                if (password_verify($this->get("pass"), $user['passwrd'])){
                    if($user['alive'] == 1){
                        if($user['stat']==1){
                            $this->responce =
                                ["success" => true,
                                 "message" => ""];
                        }else{
                            $this->responce =
                                ["success" => false,
                                "message" => "Օգտատիրոջ մուտքը հաստատված չէ"];}
                    }else{
                        $this->responce =
                            ["success" => false,
                            "message" => "Օգտատերը հեռացված է"];}
                }else{
                    $this->responce =
                        ["success" => false,
                        "message" => "Սխալ տվյալներ"];
                }
            }
        }
       return $this->responce;
    }



}