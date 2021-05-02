<?php
//conection to all class 
require_once('init.php');

// Building a class for User
class User{
	//Class variables
	private $user_id;
    private $email;
	private $password;
	private $full_name1;
	private $full_name2;
	private $date_of_wedding;
	private $hour_of_wedding;
	private $budget;
	private $role;
    
	// A function that takes all the record in a user table and puts them into an array of objects
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
    // Two functions that make the record an object   
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
	 
	// Function that finds a user by email and password
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
	//Function that finds a user by email
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
	// Function that finds a user by user_id
	public function find_user_by_id($id){
        global $database;
        $error=null;
        $result=$database->query("select * from users where user_id='".$id."'");
        if (!$result)
            $error='Can not find the user.  Error is:'.$database->get_connection()->error;
        elseif ($result->num_rows>0){
            $found_user=$result->fetch_assoc();
			$this->instantation($found_user);
        }
         else
             $error="Can no find user by this id";
		 
        return $error;
	}
	//Function that finds a user by email
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
	//Function that add new user
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
	//Function that update_data for user
	public function update_data($email,$full_name1,$full_name2,$date_of_wedding,$hour_of_wedding,$budget){
        global $database;
        $error=null;
        $result=$database->query("UPDATE `users` SET `full_name1` ='".$full_name1."',`full_name2` ='".$full_name2."',`date_of_wedding` ='".$date_of_wedding."',`hour_of_wedding` ='".$hour_of_wedding."',`budget` ='".$budget."' WHERE `email`='".$email."'");
        return $error;  
    }
	
	// get function
    public function __get($property){
        if (property_exists($this,$property))
            return $this->$property;
    }

   
}

    
?>

