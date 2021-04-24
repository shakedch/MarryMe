<?php
  
require_once('init.php');

class User{
	private $user_id;
    private $email;
	private $password;
	private $full_name1;
	private $full_name2;
	private $date_of_wedding;
	private $hour_of_wedding;
	private $budget;
	private $role;
    

    public static function fetch_users(){
        
        global $database;
        $result=$database->query("select * from users");
        $users=null;
        if ($result){
            $i=0;
            if ($result->num_rows>0){ 
                while($row=$result->fetch_assoc()){ 
                    $user=new User();
                    $user->instantation($row);
                    $users[$i]=$user;
                    $i+=1;
                }
            }
        }
        return $users;
    }
        
    private function has_attribute($attribute){
        
        $object_properties=get_object_vars($this);
        return array_key_exists($attribute,$object_properties);
    }
    
     private function  instantation($user_array){
        foreach ($user_array as $attribute=>$value){
            if ($result=$this->has_attribute($attribute))
                $this->$attribute=$value;
       }
     }
	 
	public function find_user_by_name($email,$password){
        global $database;
        $error=null;
        $result=$database->query("select * from users where email='".$email."' and password='".$password."'");
        if (!$result)
            $error='Cant not find the user.  Error is:'.$database->get_connection()->error;
        elseif ($result->num_rows>0){
            $found_user=$result->fetch_assoc();
			$this->instantation($found_user);
        }
         else
             $error="Can no find user by this Email";
		 
        return $error;

    }
	public function find_user_by_email($email){
        global $database;
        $error=null;
        $result=$database->query("select * from users where email='".$email."'");
        if (!$result)
            $error='Can not find the user.  Error is:'.$database->get_connection()->error;
        elseif ($result->num_rows>0){
            $found_user=$result->fetch_assoc();
			$this->instantation($found_user);
        }
         else
             $error="Can no find user by this Email";
		 
        return $error;
	}
	public function find_email($email){
        global $database;
        $error=null;
        $result=$database->query("select * from users where email='".$email."'");
        if (!$result)
            $error=null;
        elseif ($result->num_rows>0){
            $error = 'error';
        }
         else
             $error=null;
		 
        return $error;
	}
    public static function add_user($email,$password,$full_name1,$full_name2,$date_of_wedding,$hour_of_wedding,$budget){
        global $database;
        $error=null;
		$Save_Password=md5($password);
		$role = 'couple';
        $sql="Insert into users(email,password,full_name1,full_name2,date_of_wedding,hour_of_wedding,budget,role) values ('".$email."','".$Save_Password."','".$full_name1."','".$full_name2."','".$date_of_wedding."','".$hour_of_wedding."','".$budget."','".$role."')";
        $result=$database->query($sql);
        if (!$result)
            $error='Can not add user.  Error is:'.$database->get_connection()->error;
        return $error;
        
    }
	public function update_data($email,$full_name1,$full_name2,$date_of_wedding,$hour_of_wedding,$budget){
        global $database;
        $error=null;
        $result=$database->query("UPDATE `users` SET `full_name1` ='".$full_name1."',`full_name2` ='".$full_name2."',`date_of_wedding` ='".$date_of_wedding."',`hour_of_wedding` ='".$hour_of_wedding."',`budget` ='".$budget."' WHERE `email`='".$email."'");
        return $error;  
    }
	
	
    public function __get($property){
        if (property_exists($this,$property))
            return $this->$property;
    }

   
}

    
?>

