<?php
include ('AbstractUser.php');

class User extends AbstractUser
{
	private $pass1;
	private $checks;
	private $DB;
	private $responce;

    function __construct() {
		$this->DB = new PDO('mysql:host=localhost;dbname=userbaza','root', '',
            [PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
             PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        //$this->DB = mysqli_connect('localhost', "root", '', 'userbaza');

	}


    private function  regpashesh(){
		$this->set("pass", password_hash($this->get("pass"), PASSWORD_DEFAULT));
	}

//--------stugel passeri hamapatasxanutyuny-------------
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

//--------stugel tenc mail ogtater ka teche-------------
	private function checkUser(){
	    $value = "SELECT mail FROM users WHERE mail = :mail";
	    $user = $this->DB->prepare($value);
	    $user->bindParam(':mail', $this->get('mail'), PDO::PARAM_STR);
	    $user->execute();
	    $usero = $user->fetch();

        if($usero['mail']){
            $this->responce = [
                "success" => false,
                "message" => "Տվյալ էլ.հասցեն արդեն գրանցված է"];
            return false;
        }
        return true;
    }

//--------katarel stugumner ev grancel ogtater
    public function grancelUser()
    {
        $this->set("mail", $_POST["regmail"]);
        $this->set("pass", $_POST["regpswrd"]);
        $this->pass1 = $_POST["regpswrd1"];

        if (!$this->checkPass()){
            return $this->responce;
        }

        if (!$this->checkUser()){
            return $this->responce;
        }

        $this->randnumber10();
        $this->regpashesh();
        //$this->set("pass", $this->DB->quote($this->get("pass")));
        $insert = "INSERT INTO users (passwrd, mail, checks) VALUES (:pass, :mail, :checks)";
        $value = $this->DB->prepare($insert);
        $value->bindParam(':pass', $this->get('pass'), PDO::PARAM_STR);
        $value->bindParam(':mail', $this->get('mail'), PDO::PARAM_STR);
        $value->bindParam(':checks', $this->get('checks'), PDO::PARAM_INT);

        if ($value->execute()){
            $adress = SITE."/activation/".$this->get('mail')."/".$this->get('checks');
            $message = "Հարգելի օգտատեր, հաշիվը ակտիվացնելու համար անցեք ".$adress;
            Mail::send($this->get("mail"), "Ակտիվացում", $message);
            mkdir(ROOT . "/userfolders/".$this->get("mail"), 0644);
            return $this->responce = [
                "success" => true,
                "message" => "Բարեհաջող գրանցում, <br>Նշված էլ.հասցեին ուղարկվել է նամակ, հաստատելու համար անցեք հղումով"
            ];
        }else{
            print_r($this->DB->errorInfo());
        }

        return $this->responce;
    }


//------kayqum mutq gorceluc stugel tvyalnery
	public function check()
    {
        if (!$_POST["mail"]) {
            return $this->responce =
                ["success" => false,
                    "message" => ""];
        }

        if (!$_POST["passwrd"]) {
            return $this->responce =
                ["success" => false,
                    "message" => ""];
        }

        $value = "SELECT passwrd, stat, alive  FROM users WHERE mail= :mail";
        $user = $this->DB->prepare($value);
        $user->bindParam(":mail", $_POST["mail"], PDO::PARAM_STR);
        $user->execute();
        $usero = $user->fetch();


        if (!password_verify($_POST["passwrd"], $usero['passwrd'])) {
            echo $_POST["passwrd"], $usero['passwrd'];
            return $this->responce =
                ["success" => false,
                    "message" => "Սխալ տվյալներ"];
        }

        if ($usero['alive'] != 1) {
            return $this->responce =
                ["success" => false,
                    "message" => "Օգտատերը հեռացված է"];
        }

        if ($usero['stat'] != 1) {
            return $this->responce =
                ["success" => false,
                    "message" => "Օգտատիրոջ մուտքը հաստատված չէ"];
        }

        return $this->responce =
            ["success" => true,
                "message" => ""];
    }

//-----grancveluc heto aktivacnel
    public function activation($params){
	    $value = "SELECT checks, stat, alive FROM users WHERE mail= :mail";
	    $user = $this->DB->prepare($value);
	    $user->bindParam(":mail", $params['mail'], PDO::PARAM_STR);
        $user->execute();
	    $usero = $user->fetch();

        if ($usero['checks'] != $params['key']){
            return $this->responce = [
                "success" => false,
                "message" => "Սխալ տվյալներ"];
        }

        if ($usero['alive'] == 0 && $usero['alive'] != 1){
            return $this->responce = [
                "success" => false,
                "message" => "Օգտատերը հեռացված է"];
        }

        if ($usero['stat'] == 1 && $usero['stat'] != 0){
            return $this->responce = [
                "success" => false,
                "message" => "Արդեն ակտիվ է"];
        }

        $value = "UPDATE users SET stat=1 WHERE mail= :mail";
        $update = $this->DB->prepare($value);
        $update->bindParam(":mail", $params['mail'], PDO::PARAM_STR);

        if ($update->execute()){
            return $this->responce = [
                "success" => true,
                "message" => "Բարեհաջող ակտիվացում"];
        }

        return $this->responce = [
            "success" => false,
            "message" => $this->DB->errorInfo()];
        }
}