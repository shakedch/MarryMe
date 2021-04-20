<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />

    <link href="../../css/general.css?v=1.0" rel="stylesheet" type="text/css" />
    <link href="../../css/market.css?v=1.0" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
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
    <div class="container">
        <?php
        $mysqli = new mysqli("localhost:3308", "root", "", "marryme") or die(mysqli_error(($mysqli)));
        $result = $mysqli->query("SELECT * FROM offers") or die($mysqli->error);

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
                <h1 class="head-text">Market</h1>
            </div>
        </div>
        <div class="market-items">
            <?php
            while ($row = $result->fetch_assoc()) : ?>
                <div id="offer-frame">
                    <div class="market-item">
                        <table class="table">
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
                                <td><button name="<?php echo $row['vendor_id'] ?>" class="btn btn-info" onclick="parent.location='vendorDetails.php'"><i class="fas fa-address-card"></i> </button></td>
                            </tr>
                        </table>
                        <img class="market-item-image" src="../../assets/img/parallax_offers.png"> <!-- לראות איך שולפים תמונה-->
                        <div class="market-item-details">
                            <span class="market-item-price">&#8362 <?php echo $row['price'] ?></span>
                            <button class="market-item-button" type="button">ADD TO WISHLIST &#8594</button>
                        </div>
                    </div>
                    <div class="item-description">
                        <?php echo $row['description'] ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://rawgithub.com/pederan/Parallax-ImageScroll/master/jquery.imageScroll.min.js" type="text/javascript"></script>
    <script src="../general.js"></script>

</body>

</html>