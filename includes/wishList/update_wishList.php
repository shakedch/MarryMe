<?php
//conection to all class 
require_once '../../conection/init.php';
global $session;
global $database;
$id = $_GET['id'];
$contact_supplier = $_GET['wishlist'];
$vendor_email = $_GET['vendor_email'];
$offer_name = $_GET['offer_name'];
var_dump($id);
var_dump($contact_supplier);
var_dump($vendor_email);
var_dump($offer_name);

$num = 1;

if ($id) {
    if ($contact_supplier == "0") {
        $result = $database->query("UPDATE wishlist SET is_contact_supplier= '" . $num . "' WHERE whistlist_id = '" . $id . "'");
        header("Location: mailto: $vendor_email?subject= $offer_name");
    }
} else {
    echo "Error send email "; // display error message if not update
    header("location:wishList.php");
}
   


// header("location:wishList.php"); // redirects to all records page

// if ($result) {
//     header("location:wishList.php"); // redirects to all records page
// }