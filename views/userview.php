<?php
//$checkUser = new CheckUser();
//$check = $checkUser->check();
if ($check["success"]){
    include ("views/user_page.php");
}else{
    include ("views/login_form.php");};
