<?php

if (isset($_POST["wishlist"])) {
    require_once '../../conection/init.php';

    $vId = $_POST["Vid"];
    $oId = $_POST["Oid"];
    $userId = $_SESSION["id"];

    if (isset($vId) && isset($oId)) {
        $mysqli = new mysqli("localhost", "root", "", "marryme") or die(mysqli_error(($mysqli)));
        $sql = "INSERT INTO wishlist (offer_id, vendor_id, user_id) VALUES ($oId, $vId, $userId)";
        $sql1 = "SELECT * FROM wishlist WHERE offer_id= '" . $oId . "' AND vendor_id= '" . $vId . "' AND user_id='" . $userId . "'";
        $result = $mysqli->query($sql1);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['message'] = "This offer is already in wishlist";
            $_SESSION['msg_type'] = "alertDangerWish";
            header("location: ../marketAndOffers/market.php?success");
        } elseif ($mysqli->query($sql) === TRUE) {
            $_SESSION['message'] = "Offer has been added to wishlist!";
            $_SESSION['msg_type'] = "alertSuccessWish";
            header("location: ../marketAndOffers/market.php?success");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
} else {
    header("location: ../marketAndOffers/market.php");
    exit();
}