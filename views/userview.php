<?php
//$checkUser = new CheckUser();
//$check = $checkUser->check();
if ($data["success"]){
    include ("views/user_page.php");
}else{
    include ("views/login_form.php");};
