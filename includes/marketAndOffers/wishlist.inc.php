<?php    

    if (isset($_POST["wishlist"])) {
        require_once '../../conection/init.php';

       $vId = $_POST["Vid"];
       $oId = $_POST["Oid"];
       $userId = $_SESSION["id"];

       if (isset($vId) && isset($oId)){
            $mysqli = new mysqli("localhost", "root", "", "marryme") or die(mysqli_error(($mysqli)));
            $sql = "INSERT INTO wishlist (offer_id, vendor_id, user_id) VALUES ($oId, $vId, $userId)";
            if ($mysqli->query($sql) === TRUE) {
                header("location: ../marketAndOffers/market.php?success");
                exit();
            } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
       }
    }
    else {
        header("location: ../marketAndOffers/market.php");
        exit();
    }