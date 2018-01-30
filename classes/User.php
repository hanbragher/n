<?php
include ('AbstractUser.php');

class User extends AbstractUser
{
	private $pass1;
	private $checks;
	private $DB;
	private $responce;

	function __construct() {
		$this->DB = new PDO('mysql:host=localhost;dbname=userbaza','root', '');
        //$this->DB = mysqli_connect('localhost', "root", '', 'userbaza');

	}


	private function  regpashesh(){
		$this->set("pass", password_hash($this->get("pass"), PASSWORD_DEFAULT));
	}


	private function checkPass(){
		if($this->get("pass")) {
            if ($this->pass1 == $this->get("pass")){
                return true;
		    }else{
                $this->responce = [
                "success" => false,
                "message" => "password error"];}
        return false;
	}}

	private function checkUser(){
	    $value = "SELECT mail FROM users WHERE mail=".$this->get('mail');

	    $user = $this->DB->query($value);

	    $user = $user->fetch(PDO::FETCH_ASSOC);

        //$user = mysqli_query($this->DB, $value);
        //$user = mysqli_fetch_assoc($user);

        if($user["mail"]){
            return $this->responce = [
                "success" => false,
                "message" => "Տվյալ էլ.հասցեն արդեն գրանցված է"];
        }
        return true;
    }

	public function check()
    {
        $this->set("mail", $_POST["mail"]);
        $this->set("pass", $_POST["passwrd"]);

        if (!$this->get("mail")) {
            return $this->responce =
                ["success" => false,
                    "message" => ""];
        }

        if (!$this->get("pass")) {
            return $this->responce =
                ["success" => false,
                    "message" => ""];
        }

        //$baza = $this->DB;
        $value = "SELECT passwrd, stat, alive  FROM users WHERE mail=". $this->get("mail");

        $user = $this->DB->query($value);

        $user = $user->fetch(PDO::FETCH_ASSOC);
        //$user = mysqli_query($baza, $value);
        //$user = mysqli_fetch_assoc($user);

        if (!password_verify($this->get("pass"), $user['passwrd'])) {
            return $this->responce =
                ["success" => false,
                    "message" => "Սխալ տվյալներ"];
        }

        if ($user['alive'] != 1) {
            return $this->responce =
                ["success" => false,
                    "message" => "Օգտատերը հեռացված է"];
        }

        if ($user['stat'] != 1) {
            return $this->responce =
                ["success" => false,
                    "message" => "Օգտատիրոջ մուտքը հաստատված չէ"];
        }

        return $this->responce =
            ["success" => true,
                "message" => ""];
    }


	public function grancelUser()
    {

	    /*$this->set("mail", $_POST["regmail"]);
	    $this->set("pass", ($_POST["regpswrd"]));
	    $this->pass1 = ($_POST["regpswrd1"]);*/

	    $this->set("mail", $this->DB->quote($_POST["regmail"]));
	    $this->set("pass", $this->DB->quote($_POST["regpswrd"]));
	    $this->pass1 = $this->DB->quote($_POST["regpswrd1"]);



        $this->randnumber10();

        if (!$this->checkPass()){
            return $this->responce;
        }

        if (!$this->checkUser()){
            return $this->responce;
        }
        echo 34234234;
echo $this->get("mail");
echo $this->get("pass");
echo  $this->get('checks');
        echo SITE;

        $this->regpashesh();

        $this->set("pass", $this->DB->quote($this->get("pass")));

        $value = "INSERT INTO users (passwrd, mail, checks) VALUES (".$this->get('pass').",". $this->get('mail') .",". $this->get('checks').")";
echo $value;
        if ($this->DB->query($value)){
            $adress = SITE."/activation/".$this->get('mail')."/".$this->get('checks');
            $message = "Հարգելի օգտատեր, հաշիվը ակտիվացնելու համար անցեք ".$adress;
            Mail::send($this->get("mail"), "Ակտիվացում", $message);
            mkdir(ROOT . "/userfolders/".$this->get("mail"), 0644);
            return $this->responce = [
                "success" => true,
                "message" => "Բարեհաջող գրանցում, <br>Նշված էլ.հասցեին ուղարկվել է նամակ, հաստատելու համար անցեք հղումով"
            ];
        }else{ print_r($this->DB->errorInfo());
           // return $this->responce = [
               // "success" => false,
               // "message" => mysqli_error($this->DB)
            //];
        }



       /* if (mysqli_query($this->DB, $value)) {
                $adress = SITE."/activation/".$this->get('mail')."/".$this->get('checks');
                $message = "Հարգելի օգտատեր, հաշիվը ակտիվացնելու համար անցեք ".$adress;
        	    Mail::send($this->get("mail"), "Ակտիվացում", $message);
                mkdir(ROOT . "/userfolders/".$this->get("mail"), 0644);
                $this->responce = [
                	"success" => true,
	                "message" => "Բարեհաջող գրանցում, <br>Նշված էլ.հասցեին ուղարկվել է նամակ, հաստատելու համար անցեք հղումով"
                ];
        }else{
	        $this->responce = [
		        "success" => false,
		        "message" => mysqli_error($this->DB)
	        ];
        }*/

        return $this->responce;
    }

    public function activation($params){
	    //$baza = $this->DB;
	    $value = "SELECT checks, stat, alive FROM users WHERE mail=".$params['mail'];
        $user = $this->DB->query($value);
	    $user = $user->fetch(PDO::FETCH_ASSOC);

	    //$user = mysqli_query($baza, $value);
        //$user = mysqli_fetch_assoc($user);
echo $user['checks'];
        if ($user['checks'] != $params['key']){
            return $this->responce = [
                "success" => false,
                "message" => "Սխալ տվյալներ"];
        }

        if ($user['alive'] == 0 && $user['alive'] != 1){
            return $this->responce = [
                "success" => false,
                "message" => "Օգտատերը հեռացված է"];
        }

        if ($user['stat'] == 1 && $user['stat'] != 0){
            return $this->responce = [
                "success" => false,
                "message" => "Արդեն ակտիվ է"];
        }

        $value = "UPDATE users SET stat=1 WHERE mail=".$params['mail'];

        if ($this->DB->query($value)){
            return $this->responce = [
                "success" => true,
                "message" => "Բարեհաջող ակտիվացում"];
        }

        return $this->responce = [
            "success" => false,
            "message" => mysqli_error($this->DB)];
        }


        /*if (mysqli_query($baza, $value)){
            return $this->responce = [
                "success" => true,
                "message" => "Բարեհաջող ակտիվացում"];
        }

        return $this->responce = [
                "success" => false,
                "message" => mysqli_error($this->DB)];*/

}