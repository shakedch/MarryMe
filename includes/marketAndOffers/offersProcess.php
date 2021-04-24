<?php

session_start();

$mysqli = new mysqli("localhost:3308", "root", "", "marryme") or die(mysqli_error(($mysqli)));

$offer_id = 0;
$update = false;
$name = '';
$valid_date = '';
$description =  '';
$price = '';
$img = '';
$vendor_id = '';

// add new form
if (isset($_POST['save'])) {

    $name = $_POST['name'];
    $valid_date =  $_POST['valid_date'];
    $description =  $_POST['description'];
    $price =  $_POST['price'];
    $img =  $_POST['img'];
    $vendor_id =  2;/*צריך לבדוק איך נותנים לזה סשן ואת מי שמחובר */

    $mysqli->query("INSERT INTO offers (valid_date, name, description, img, price, vendor_id) VALUES ('$valid_date', '$name', '$description', '$img', '$price', '$vendor_id')") or die($mysqli->error);

    $_SESSION['message'] = "Offer has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: offers.php");
}

//delete form
if (isset($_GET['delete'])) {
    $offer_id = $_GET['delete'];

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
    $img =  $_POST['img']; // צריך לטפל בעדכון תמונה
    $vendor_id =  1;/*צריך לבדוק איך נותנים לזה סשן ואת מי שמחובר */

    echo "<script type='text/javascript'>alert('$description');</script>";

    $mysqli->query("UPDATE offers SET name='$name',valid_date='$valid_date',description='$description',price='$price',img='$img',vendor_id='$vendor_id' WHERE offer_id=$offer_id ") or die($mysqli->error);
    $_SESSION['message'] = "offer has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: offers.php");
}
