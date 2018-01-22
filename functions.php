<?php
define ('ROOT', __DIR__);
define ('SITE', 'http://n/');
include (ROOT."/classes/NewUser.php");

function bazakpnel(){
    return mysqli_connect('localhost', 'root', '', 'userbaza');
};

function trimstrip($a){
    return trim(strip_tags($_POST[$a]));
};

// stugel granceluc tvyalnery
function stugelpass(){
    $regpswrd = trimstrip('regpswrd');
    $regpswrd1 = trimstrip('regpswrd1');
    if($regpswrd){
        if($regpswrd1){
            if(!strcmp($regpswrd, $regpswrd1) == 0){
                echo "Գաղտնաբառերը չեն համապատասխանում";
            }elseif(stugeluser()){
                newuser();
            };

        }}};

function stugeluser(){
    $regmail = trimstrip('regmail');
    $value = "SELECT mail FROM users WHERE mail='".$reglogin."'";
    $usermail = mysqli_query(bazakpnel(), $value);
    $usermail = mysqli_fetch_assoc($usermail);
    if ($usermail){
        echo "Տվյալ Էլ.հասցեով օգտատեր գոյություն ունի, խնդրում ենք մուտքագրել այլ";
        return false;
    }else{
        return true;};
};

function newuser(){
    $user = new NewUser(trimstrip('reglogin'),
                        trimstrip('regpswrd'),
                        trimstrip('regmail'));
    $user->grancelUser();
};