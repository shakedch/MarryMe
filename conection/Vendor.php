<?php
//conection to all class 
require_once('init.php');

// Building a class for Vendor
class Vendor
{
    //Class variables
    private $vendor_id;
    private $email;
    private $password;
    private $company_name;
    private $phone_num;
    private $kind_of_business;
    private $web_url;
    private $address;
    private $role;

    // A function that takes all the record in a Vendor table and puts them into an array of objects
    public static function fetch_users()
    {

        global $database;
        $result = $database->query("select * from vendors");
        $vendors = null;
        if ($result) {
            $i = 0;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $vendor = new Vendor();
                    $vendor->instantation($row);
                    $vendors[$i] = $vendor;
                    $i += 1;
                }
            }
        }
        return $vendors;
    }
    // Two functions that make the record an object      
    private function has_attribute($attribute)
    {

        $object_properties = get_object_vars($this);
        return array_key_exists($attribute, $object_properties);
    }

    private function  instantation($user_array)
    {
        foreach ($user_array as $attribute => $value) {
            if ($result = $this->has_attribute($attribute))
                $this->$attribute = $value;
        }
    }

    // Function that finds a Vendor by email and password
    public function find_user_by_name($email, $password)
    {
        global $database;
        $error = null;
        $result = $database->query("select * from vendors where email='" . $email . "' and password='" . $password . "'");
        if (!$result)
            $error = 'Cannot find the user.  Error is:' . $database->get_connection()->error;
        elseif ($result->num_rows > 0) {
            $found_user = $result->fetch_assoc();
            $this->instantation($found_user);
        } else
            $error = "Cannot find user by this Email";

        return $error;
    }
    //Function that finds a Vendor by email
    public function find_email($email)
    {
        global $database;
        $error = null;
        $result = $database->query("select * from vendors where email='" . $email . "'");
        if (!$result)
            $error = null;
        elseif ($result->num_rows > 0) {
            $error = 'error';
        } else
            $error = null;

        return $error;
    }
    // Function that finds a Vendor by vendor_id
    public function find_user_by_id($id)
    {
        global $database;
        $error = null;
        $result = $database->query("select * from vendors where vendor_id='" . $id . "'");
        if (!$result)
            $error = 'Cannot find the vendor.  Error is:' . $database->get_connection()->error;
        elseif ($result->num_rows > 0) {
            $found_user = $result->fetch_assoc();
            $this->instantation($found_user);
        } else
            $error = "Cannot find vendor by this id";

        return $error;
    }
    // Function that finds a Vendor by vendor_id and give yes or no
    public function find_vendor($id)
    {
        global $database;
        $error = null;
        $result = $database->query("select * from vendors where vendor_id='" . $id . "'");
        if (!$result)
            $error = null;
        elseif ($result->num_rows > 0) {
            $error = 'error';
        } else
            $error = null;

        return $error;
    }
    //Function that finds a Vendor by email
    public function find_user_by_email($email)
    {
        global $database;
        $error = null;
        $result = $database->query("select * from vendors where email='" . $email . "'");
        if (!$result)
            $error = 'Cannot find the user.  Error is:' . $database->get_connection()->error;
        elseif ($result->num_rows > 0) {
            $found_user = $result->fetch_assoc();
            $this->instantation($found_user);
        } else
            $error = "Cannot find user by this Email";

        return $error;
    }
    //Function that add new Vendor
    public static function add_Vendor($email, $password, $company_name, $phone_num, $kind_of_business, $web_url, $address)
    {
        global $database;
        $error = null;
        $Save_Password = md5($password);
        $role = 'Vendor';
        $sql = "Insert into vendors(email,password,company_name,phone_num,kind_of_business,web_url,address,role) values ('" . $email . "','" . $Save_Password . "','" . $company_name . "','" . $phone_num . "','" . $kind_of_business . "','" . $web_url . "','" . $address . "','" . $role . "')";
        $result = $database->query($sql);
        if (!$result)
            $error = 'Cannot add user.  Error is:' . $database->get_connection()->error;
        return $error;
    }
    //Function that update_data for Vendor
    public function update_data($email, $company_name, $phone_num, $kind_of_business, $web_url, $address)
    {
        global $database;
        $error = null;
        $result = $database->query("UPDATE `vendors` SET `company_name` ='" . $company_name . "',`phone_num` ='" . $phone_num . "',`kind_of_business` ='" . $kind_of_business . "',`web_url` ='" . $web_url . "',`address` ='" . $address . "' WHERE `email`='" . $email . "'");
        return $error;
    }
    // get function
    public function __get($property)
    {
        if (property_exists($this, $property))
            return $this->$property;
    }
}
