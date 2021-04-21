<?php
  
require_once('init.php');

class Vendor{
	private $vendor_id;
    private $email;
	private $password;
	private $company_name;
	private $phone_num;
	private $kind_of_business;
	private $web_url;
    private $address;
	private $role;
    

    public static function fetch_users(){
        
        global $database;
        $result=$database->query("select * from vendors");
        $vendors=null;
        if ($result){
            $i=0;
            if ($result->num_rows>0){ 
                while($row=$result->fetch_assoc()){ 
                    $vendor=new Vendor();
                    $vendor->instantation($row);
                    $vendors[$i]=$vendor;
                    $i+=1;
                }
            }
        }
        return $vendors;
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
        $result=$database->query("select * from vendors where email='".$email."' and password='".$password."'");
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
	public function find_email($email){
        global $database;
        $error=null;
        $result=$database->query("select * from vendors where email='".$email."'");
        if (!$result)
            $error=null;
        elseif ($result->num_rows>0){
            $error = 'error';
        }
         else
             $error=null;
		 
        return $error;
	}
	public function find_user_by_email($email){
        global $database;
        $error=null;
        $result=$database->query("select * from vendors where email='".$email."'");
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
    public static function add_Vendor($email,$password,$company_name,$phone_num,$kind_of_business,$web_url,$address){
        global $database;
        $error=null;
		$Save_Password=md5($password);
		$role = 'Vendor';
        $sql="Insert into vendors(email,password,company_name,phone_num,kind_of_business,web_url,address,role) values ('".$email."','".$Save_Password."','".$company_name."','".$phone_num."','".$kind_of_business."','".$web_url."','".$address."','".$role."')";
        $result=$database->query($sql);
        if (!$result)
            $error='Can not add user.  Error is:'.$database->get_connection()->error;
        return $error;  
    }
	
	public function update_data($email,$company_name,$phone_num,$kind_of_business,$web_url,$address){
        global $database;
        $error=null;
        $result=$database->query("UPDATE `vendors` SET `company_name` ='".$company_name."',`phone_num` ='".$phone_num."',`kind_of_business` ='".$kind_of_business."',`web_url` ='".$web_url."',`address` ='".$address."' WHERE `email`='".$email."'");
        return $error;  
    }
	
    public function __get($property){
        if (property_exists($this,$property))
            return $this->$property;
    }  
}
?>

