<?php
include ('User.php');

class NewUser extends User
{
	private $pass1;
	private $checks;
	private $DB;
	private $responce;

	function __construct() {
		$this->DB = mysqli_connect('localhost', "root", '', 'userbaza');
		$this->set("mail", $_POST["regmail"]);
		$this->set("pass", $_POST["regpswrd"]);
		$this->pass1 = $_POST["regpswrd1"];
		$this->randnumber10("checks");
	}

	private function  regpashesh(){
		$this->set("pass", password_hash($this->get("pass"), PASSWORD_DEFAULT));
	}


	private function checkPass(){
		if($this->get("pass")){
			if($this->pass1 == $this->get("pass")){
				return true;
			}

		}
		 $this->responce = [
			"success" => false,
			"message" => "password error"
		];
		return false;
	}

	public function grancelUser()
    {

    	if (!$this->checkPass()){
    		return $this->responce;
	    }

    	$this->regpashesh();
    	$value = "INSERT INTO users (passwrd, mail, checks) VALUES ('".$this->get('pass')."','".$this->get('mail')."','".$this->get('checks')."')";
        if (mysqli_query($this->DB, $value)) {
                $adress = SITE."/activation/?mail=".$this->get('mail')."&key=".$this->get('checks');
                $message = "Հարգելի օգտատեր, հաշիվը ակտիվացնելու համար անցեք ".$adress;
        	    Mail::send($this->get('mail'), "Ակտիվացում", $message);
                mkdir(ROOT . "/userfolders/".$this->get("mail"), 0644);
                $this->responce = [
                	"success" => true,
	                "message" => "Բարեհաջող գրանցում, <br>Նշված էլ.հասցեին ուղարկվել է նամակ, հաստատելու համար անցեք հղումով"
                ];
        }else {
	        $this->responce = [
		        "success" => false,
		        "message" => mysqli_error($this->DB)
	        ];
        }

        return $this->responce;
    }
}