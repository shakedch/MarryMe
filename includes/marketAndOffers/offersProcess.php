<?php
require_once '../../conection/init.php';
global $session;


$mysqli = new mysqli("localhost", "root", "", "marryme") or die(mysqli_error(($mysqli)));

$offer_id = 0;
$update = false;
$name = '';
$valid_date = '';
$description =  '';
$price = '';
$img = '';
$vendor_id = '';

//set Israel time 
date_default_timezone_set('Israel');

// add new form
if (isset($_POST['save'])) {

    $name = $_POST['name'];
    $valid_date =  $_POST['valid_date'];
    $creation_date = date('Y-m-d H:i:s');
    $description =  $_POST['description'];
    $price =  $_POST['price'];
    $vendor_id =  $session->id;

    $img = uploadImg();

    $mysqli->query("INSERT INTO offers (valid_date, name, description, img, price, vendor_id,creation_date) VALUES ('$valid_date', '$name', '$description', '$img', '$price', '$vendor_id', '$creation_date')") or die($mysqli->error);

    $_SESSION['message'] = "Offer has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: offers.php");
}

//delete form
if (isset($_GET['delete'])) {
    $offer_id = $_GET['delete'];

    //delete record image
    $result =  $mysqli->query("SELECT * FROM offers WHERE offer_id=$offer_id") or die($mysqli->error);
    $row = $result->fetch_array();
    $temp_img_to_delete = $row['img'];

    //delete image if exist
    if ($temp_img_to_delete !== '') {
        // Use unlink() function to delete a file 
        $file_pointer = "../../assets/img/offersUploads/" . $temp_img_to_delete;
        if (file_exists($file_pointer)) {
            unlink($file_pointer);
        }
    }

    $mysqli->query("DELETE FROM offers WHERE offer_id=$offer_id") or die(mysqli_error(($mysqli)));

    $_SESSION['message'] = "Offer has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: offers.php");
}

//edit form
if (isset($_GET['edit'])) {
    $offer_id = $_GET['edit'];
    $update = true;
    $result =  $mysqli->query("SELECT * FROM offers WHERE offer_id=$offer_id") or die($mysqli->error);
    if (count(array($result)) == 1) {
        $row = $result->fetch_array();
        $name = $row['name'];
        // $valid_date = date('Y-m-d H:i:s',$row['valid_date']); אולי למחוק לשים לב
        $valid_date = str_replace(' ', 'T', $row['valid_date']);
        $description =  $row['description'];
        $price =  $row['price'];
        $img =  $row['img'];
        $vendor_id = $row['vendor_id'];
    }
}

//update form
if (isset($_POST['update'])) {
    $offer_id = $_POST['offer_id'];
    $name = $_POST['name'];
    $valid_date =  $_POST['valid_date'];
    $description =  $_POST['description'];
    $price =  $_POST['price'];
    $vendor_id =  $session->id;

    $result =  $mysqli->query("SELECT * FROM offers WHERE offer_id=$offer_id") or die($mysqli->error);
    $row = $result->fetch_array();
    $temp_img_to_delete = $row['img'];

    $img = uploadImg();

    //If there is no new image
    if ($img === '') {
        $mysqli->query("UPDATE offers SET name='$name',valid_date='$valid_date',description='$description',price='$price',vendor_id='$vendor_id' WHERE offer_id=$offer_id ") or die($mysqli->error);
    } else {

        //delete prev image if exist
        if ($temp_img_to_delete !== '') {
            // Use unlink() function to delete a file 
            $file_pointer = "../../assets/img/offersUploads/" . $temp_img_to_delete;
            unlink($file_pointer);
        }

        $mysqli->query("UPDATE offers SET name='$name',valid_date='$valid_date',description='$description',price='$price',img='$img',vendor_id='$vendor_id' WHERE offer_id=$offer_id ") or die($mysqli->error);
    }

    $_SESSION['message'] = "offer has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: offers.php");
}

function uploadImg()
{
    $cleanName = '';
    //Uploading image
    $filePath = pathinfo($_FILES['img']['name']);
    $ext = $filePath['extension']; // get the extension of the file
    $cleanName = $filePath['filename']; //get the name without extention

    // In case of new image
    if ($cleanName !== '') {

        //Check existing file names to avoid overwriting files
        $originalName = $cleanName;
        $num = 1;
        while (file_exists("../../assets/img/offersUploads/" . $cleanName . "." . $ext)) {
            $cleanName = (string)$originalName . "_" . $num;
            $num++;
        }   // Add a running number if the file name already exists
        $newName = $cleanName . "." . $ext;


        $target = '../../assets/img/offersUploads/' . $newName;

        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target)) {
            echo "The photo has been uploaded.";
        } else {
            echo "There was an error uploading the photo.";
        }

        return $newName;
    }
    return $cleanName;
}
