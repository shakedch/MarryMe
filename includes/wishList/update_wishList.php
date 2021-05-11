<?php
//conection to all class 
require_once '../../conection/init.php';
global $session;
global $database;
$id = $_GET['id'];
$num = 1 ;
$result=$database->query("UPDATE wishlist SET is_contact_supplier= '".$num."' WHERE whistlist_id = '".$id."'");
if($result)
{
    header("location:offer_wish.php"); // redirects to all records page
}
else
{
    echo "Error send email "; // display error message if not update
	header("location:offer_wish.php");
}

?>