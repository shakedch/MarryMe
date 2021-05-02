<?php
 // take the login variables form config
require_once('config.php');

// Building a class for Database
class Database{
    //Class variables
    private $connection;
    
	//constructor
    function __construct(){
        $this->open_db_connection();
    }
	//make conection to DB
    private function open_db_connection(){
        
        $this->connection=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if ($this->connection->connect_error){
            $this->connection=null;
        }
    }
	//A function that checks a connection to a database
    public function get_connection(){
        return $this->connection;
    }
	// A function that sends queries to a database
    public function query($sql){
        
        $result=$this->connection->query($sql);
        if (!$result){
            return null;

        }
        else{
            return $result;
        }
    }
    
    
   
}
// Create an object
$database=new Database();

    
    

?>