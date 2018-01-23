<?php
/*$host = "localhost";
$login = "root";
$pass = "";
$bazaname = "userbaza";
$tablename = "users";*/

//
//createbaza($host, $login, $pass, $bazaname);
//creattbl($host, $login, $pass, $bazaname, $tablename);

function createbaza($host, $login, $pass, $bazaname){
    $bazaserver = mysqli_connect($host, $login, $pass);
    $sql = "CREATE DATABASE $bazaname";
    if (mysqli_query($bazaserver, $sql)){
        echo "Պահոցը հաջողությամբ ստեղծված է<br>";
        return true;
    } else {
        echo "Պահոցի սխալ: : " . mysqli_error($bazaserver)."<br>";
        return false;
    }
};
hh
function creattbl($host, $login, $pass, $bazaname, $tablename){
    $bazaserver = mysqli_connect($host, $login, $pass);
    $sql = "CREATE TABLE `$bazaname`.`$tablename` ( 
                            `id` INT NOT NULL AUTO_INCREMENT , 
                            `username` VARCHAR(30) NOT NULL , 
                            `passwrd` VARCHAR(100) NOT NULL , 
                            `mail` VARCHAR(30) NOT NULL , 
                            `stat` INT(1) NULL DEFAULT '0' , 
                            `checks` VARCHAR(10) NULL , 
                            `alive` INT(1) NULL DEFAULT '1' , 
                            PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    if (mysqli_query($bazaserver, $sql)){
        echo "Օգտատերերի սյունակները ստեղծված են<br>";
        return true;
    } else {
        echo "Օգտատերերի սյունակների սխալ: " . mysqli_error($bazaserver)."<br>";
        return false;
    }
};
