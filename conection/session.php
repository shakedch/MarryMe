<?php
//conection to all class     
require_once('init.php');
// Building a class for Session
class Session{
	//Class variables
    private $signed_in;
	private $id;
    private $email;
	private $role;
	
	//constructor
    public function __construct(){
        session_start();
        $this->check_login();
    }
	//A function that checks a if there are a session
     private function check_login(){
        if (isset($_SESSION['email'])){
            $this->email=$_SESSION['email'];
			$this->role=$_SESSION['role'];
			$this->id=$_SESSION['id'];
            $this->signed_in=true;
        }
        else{
            unset($this->email);
            $this->signed_in=false;
        }
    }
	//A function that inserts user or vendor date into a session object
    public function login($user){
        if($user){
            $this->email=$user->email;
			$this->role=$user->role;
            $_SESSION['email']=$user->email;
			$_SESSION['role']=$user->role;
			$tepm = 'couple';
			$res=$_SESSION['role'];
			if($res == $tepm){
				$_SESSION['id']=$user->user_id;
				$this->id=$user->user_id;
			}
			else{
				$_SESSION['id']=$user->vendor_id;
				$this->id=$user->vendor_id;
			}
            $this->signed_in=true;
        }
    }
	//A function that Forget user or vendor date from session object
    public function logout(){
        echo 'logout';
        unset($_SESSION['email']);
        unset($this->email);
		unset($_SESSION['id']);
        unset($this->id);
		unset($_SESSION['role']);
        unset($this->role);
        $this->signed_in=false;   
    }   
	// get function
    public function __get($property){
        if (property_exists($this,$property))
            return $this->$property;
    }
     
}
// Create an object
$session=new Session();

    
?>

