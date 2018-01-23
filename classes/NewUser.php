<?php
include ('User.php');

class NewUser extends User
{
    public function grancelUser()
    {
        $baza = bazakpnel();
        $value = "INSERT INTO users (username, passwrd, mail, checks) VALUES ('".$this->get('username')."','".$this->get('pass')."','".$this->get('mail')."','".$this->get('checks')."')";
        if (mysqli_query($baza, $value)) {
            echo $this->get('mail');
                mailuxarkel($this->get('username'), $this->get('mail'), $this->get('checks'));
                mkdir(ROOT . "/userfolders/".$this->get('username'), 0644);
                echo "Բարեհաջող գրանցում, <br>Նշված էլ.հասցեին ուղարկվել է նամակ, հաստատելու համար անցեք հղումով";
                return true;
        }else {echo mysqli_error($baza);}
    }
}