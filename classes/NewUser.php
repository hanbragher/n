<?php
include ('User.php');

class NewUser extends User
{
    public function grancelUser()
    {
        $value = "INSERT INTO users (passwrd, mail, checks) VALUES ('".$this->get('pass')."','".$this->get('mail')."','".$this->get('checks')."')";
        if (mysqli_query(bazakpnel(), $value)) {
                mailuxarkel($this->get('mail'), $this->get('checks'));
                mkdir(ROOT . "/userfolders/".$this->get('mail'), 0644);
                echo "Բարեհաջող գրանցում, <br>Նշված էլ.հասցեին ուղարկվել է նամակ, հաստատելու համար անցեք հղումով";
                return true;
        }else {echo mysqli_error($baza);}
    }
}