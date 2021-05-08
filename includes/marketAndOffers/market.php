<?php require_once '../../conection/init.php';
global $session;
global $database;
$role = $_SESSION['role'];
$one_n = "My_Task";
$sec_n = "Market";
$thr_n = "My Offer";
$inout = "Log Out";
$SeeCre = "See Your Account";
$where0 = "../tasksProcess/tasks.php";
$where3 = "market.php";
$where1 = "../usersManagment/LogOut.php";
$where2 = "../usersManagment/My_Account.php";
$where4 = "../my_OFFER/offer_wish.php";
?>


<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../../css/HeadFoot.css">
    <link href="../../css/general.css?v=1.0" rel="stylesheet" type="text/css" />
    <link href="../../css/market.css?v=1.0" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript">
    </script>
    <script src="https://kit.fontawesome.com/90569433a0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- tab view -->
    <link rel="shortcut icon" href="../../assets/img/tab_logo.png" type="image/png">
    <title> Marry Me</title>
    <!-- general fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&family=Josefin+Sans:wght@500&family=Niconne&display=swap" rel="stylesheet">

</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark p-md-3">
        <div class="container">
            <a class="navbar-brand" href="#">Wedding</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-black" href="../../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black" href="<?php echo $where0 ?>"><?php echo $one_n ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black" href="<?php echo $where3 ?>"><?php echo $sec_n ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black" href="<?php echo $where4 ?>"><?php echo $thr_n ?></a>
                </li>
            </ul>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="mx-auto"></div>
                <span class="navbar-text text-black"><?php echo $role ?></span>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="<?php echo $where1 ?>"><?php echo $inout ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="<?php echo $where2 ?>"><?php echo $SeeCre ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php
        $mysqli = new mysqli("localhost", "root", "", "marryme") or die(mysqli_error(($mysqli)));
        $result = $mysqli->query("SELECT * FROM offers WHERE valid_date>NOW()") or die($mysqli->error);


        function findCompanyName($vendor_to_search, $mysqli)
        {
            $vendor =  $mysqli->query("SELECT * FROM vendors WHERE vendor_id=$vendor_to_search") or die($mysqli->error);
            echo $vendor->fetch_assoc()['company_name'];
        }
        ?>

        <?php require_once 'offersProcess.php'; ?>
        <div class="header">
            <div class="img-holder" data-image="../../assets/img/parallax_market.png">
            </div>
            <div>
                <h1 class="head-text typographyH1">Market</h1>
            </div>
        </div>
        <div class="market-items">
            <?php
            while ($row = $result->fetch_assoc()) :
            ?>
                <div id="offer-frame">
                    <div class="market-item">
                        <table>
                            <tr>
                                <td>
                                    <?php
                                    $vendor_to_search = $row['vendor_id'];
                                    findCompanyName($vendor_to_search, $mysqli);
                                    ?>
                                </td>
                                <td>
                                    <h3 class="market-item-title"><?php echo $row['name'] ?></h3>
                                </td>
                                <td><button name="<?php echo $row['vendor_id'] ?>" class="btn btn-info" onclick="parent.location='vendorDetails.php'"><i class="fas fa-address-card"></i>
                                    </button></td>
                            </tr>
                        </table>
                        <?php
                        echo
                        "<img class='centerPic' src='../../assets/img/offersUploads/" . (($row["img"] == '') || ($row["img"] == '.') ? 'no-image-available.png' : $row["img"]) . "' />";
                        ?>

                        <div class="market-item-details">
                            <span class="market-item-price">&#8362 <?php echo $row['price'] ?></span>
                            <button class="market-item-button" type="button">ADD TO WISHLIST &#8594 </button>
                        </div>
                    </div>
                    <div class="item-description">
                        <?php echo $row['description'] ?>
                    </div>
                </div>
            <?php

            endwhile; ?>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://rawgithub.com/pederan/Parallax-ImageScroll/master/jquery.imageScroll.min.js" type="text/javascript"></script>
    <script src="../general.js"></script>

</body>

</html>