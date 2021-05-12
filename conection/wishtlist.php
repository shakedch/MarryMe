<?php
//conection to all class   
require_once('init.php');

// Building a class for wishlist
class wishtlist{
	//Class variables
	private $whistlist_id;
	private $offer_id;
	private $vendor_id;
    private $user_id;
	private $is_contact_supplier;
    
	// A function that takes all the record in a wishlist table and puts them into an array of objects
    public static function fetch_wishtlist($id){
        
        global $database;
        $result=$database->query("select * from wishlist where user_id='".$id."'");
        $wishlists=null;
        if ($result){
            $i=0;
            if ($result->num_rows>0){ 
                while($row=$result->fetch_assoc()){ 
                    $wishlist=new wishtlist();
                    $wishlist->instantation($row);
                    $wishlists[$i]=$wishlist;
                    $i+=1;
                }
            }
        }
        return $wishlists;
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
	// Function that finds a wishlist by user_id 
	public function find_my_offer($user_id){
        global $database;
        $error=null;
        $result=$database->query("select * from wishlist where user_id='".$user_id."'");
        if (!$result)
            $error='Can not find the user.  Error is:'.$database->get_connection()->error;
        elseif ($result->num_rows>0){
            $found_user=$result->fetch_assoc();
			$this->instantation($found_user);
        }
         else
             $error="error";
		 
        return $error;
	}
	
	// get function
    public function __get($property){
        if (property_exists($this,$property))
            return $this->$property;
    }  
}
?>

