<?php
//conection to all class 
require_once '../../conection/init.php';
global $session;
global $database;
$id = $_GET['id'];
$result=$database->query("DELETE FROM wishlist WHERE whistlist_id = '".$id."'");
if($result)
{
    header("location:offer_wish.php"); // redirects to all records page
}
else
{
    echo "Error deleting record"; // display error message if not delete
	header("location:offer_wish.php");
}

?>