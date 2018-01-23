<?php
echo "boom";
if (check_login_header()){
    include ("views/user_page.php");
}else{
    include ("views/login_form.php");};
