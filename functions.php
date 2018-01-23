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

function mailuxarkel($regmail, $key){
    $vernagir = 'Բարի գալուստ';
    $text = "Էջը հաստատելու համար խնդրում են անցնել այս հղումով ".SITE."actions/account_activation.php/?mail=$regmail&key=$key";
    mail($regmail, $vernagir, $text, 'From: boom@bdish.com');
};

function user_activation(){
    $mail = $_GET["mail"];
    $key = $_GET["key"];
    if($mail){
        if($key){
            $value = "SELECT checks, stat FROM users WHERE mail='".$mail."'";
            $user = mysqli_query(bazakpnel(), $value);
            $user = mysqli_fetch_assoc($user);
            if ($user['stat'] != 1 && $user['stat'] == 0){
                if($user['checks'] == $key){
                    $value1 = "UPDATE users SET stat=1 WHERE mail='".$mail."'";
                    if (mysqli_query(bazakpnel(), $value1)){
                        echo "<a><h5 class=\"form-signin-heading\">Հաջողությամբ հաստատված է</h5></a>";
                    }else{
                        echo "<a><h class=\"form-signin-heading\">Ակտիվացման սխալ". mysqli_error(bazakpnel())."</h></a>";}
                        //echo "Ակտիվացման սխալ ". mysqli_error(bazakpnel())."<br>";}
                }else{
                    echo "<a><h class=\"form-signin-heading\">Սպառված կամ սխալ ակտիվացում</h></a>";}
                    //echo "Սպառված կամ սխալ ակտիվացում <a href=".SITE."><br>վերադառնալ կայք</a>";}
            }elseif($user['stat'] == 1){
                    echo "<a><h5 class=\"form-signin-heading\">Արդեն հաստատված է </h5></a>";}
                    //echo "Արդեն հաստատված է <a href=".SITE."><br>վերադառնալ կայք</a>";}
        }
    }
};

function check_login_header(){
    if (check_login()){
        echo "loginmmm";
    }else{
        echo "login";
    }
};

function check_login(){
    $mail = trimstrip('mail');
    $passwrd = trimstrip('passwrd');
    if($mail){
        if($passwrd){
            $value = "SELECT passwrd, stat, alive FROM users WHERE mail='".$mail."'";
            $user = mysqli_query(bazakpnel(), $value);
            $user1 = mysqli_fetch_assoc($user);
            if (password_verify($passwrd, $user1['passwrd'])){
                if($user1['alive'] == 1){
                    if($user1['stat'] == 1){
                        setcookie("mail", $mail);
                        return true;
                    }else{
                        echo "Օգտատիրոջ մուտքը հաստատված չէ";
                        return false;}
                }else{
                    echo "Օգտատերը հեռացված է";
                    return false;}
            }else{
                echo "Սխալ տվյալներ";
                return false;}
        }
    }
};