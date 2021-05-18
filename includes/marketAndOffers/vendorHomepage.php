<?php
require_once('../../conection/init.php');
require_once('../tasksProcess/insertAndDelete.php');
global $session;
$role = $_SESSION['role'];
$one_n = "Offers";
$inout = "Log Out";
$SeeCre = "See Your Account";
$where0 = "offers.php";
$where1 = "../usersManagment/logOut.php";
$where2 = "../usersManagment/myAccount.php";


$error = '';
$vendor = new Vendor();
$error = $vendor->find_user_by_email($session->email);

$mysqli = new mysqli("localhost", "root", "", "marryme") or die(mysqli_error(($mysqli)));

//relevat queries
$resultWishlist = $mysqli->query("SELECT * FROM wishlist WHERE vendor_id='" . $session->id . "' ") or die($mysqli->error);
$resultWishlistContact = $mysqli->query("SELECT * FROM wishlist WHERE vendor_id='" . $session->id . "' AND is_contact_supplier=1") or die($mysqli->error);
$resultOffers = $mysqli->query("SELECT * FROM offers WHERE vendor_id='" . $session->id . "' ") or die($mysqli->error);
$resultOffersValid = $mysqli->query("SELECT * FROM offers WHERE vendor_id='" . $session->id . "' AND valid_date>NOW() ") or die($mysqli->error);
$resultOffersExpireInAWeek = $mysqli->query("SELECT * FROM offers WHERE vendor_id='" . $session->id . "' AND valid_date>NOW() AND  valid_date<(NOW() + INTERVAL 7 DAY)") or die($mysqli->error);
$resultOffersLast30Days =  $mysqli->query("SELECT date(creation_date), COUNT(*) FROM offers WHERE vendor_id='" . $session->id . "' AND creation_date>(NOW() - INTERVAL 30 DAY) GROUP BY date(creation_date) ") or die($mysqli->error);
$resultWishlistPerOffer = $mysqli->query("SELECT offer_id, COUNT(*) FROM wishlist WHERE vendor_id='" . $session->id . "'  GROUP BY offer_id") or die($mysqli->error);


//relevant numbers
$wishlistCount = mysqli_num_rows($resultWishlist); // number of all wishlist item even if is_contact_supplier=0
$wishlistCountContact = mysqli_num_rows($resultWishlistContact); // number of  request to contact for my offers
$offersCount = mysqli_num_rows($resultOffers); // number of all my offers 
$offersCountValid = mysqli_num_rows($resultOffersValid); // number valid offers 
$offersCountExpireInAWeek = mysqli_num_rows($resultOffersExpireInAWeek); // number of offers that expire in a week

// for pie chart
if ($offersCount > 0) {
    $pieDataPoints = array(
        array("label" => "Not Valid", "y" => (($offersCount - $offersCountValid) / $offersCount) * 100),
        array("label" => "Valid", "y" => ($offersCountValid / $offersCount) * 100),

    );
} else {
    $pieDataPoints = array(
        array("label" => "Not Valid", "y" => 0),
        array("label" => "Valid", "y" => 0),

    );
}


//for bar chart
$barDataPoints = array(

    array("y" => $wishlistCountContact,  "label" => "Saved & Request for contact "),
    array("y" => ($wishlistCount - $wishlistCountContact),  "label" => "Saved"),

);

//for line chart
$lineDataPoints = array();
while ($row = $resultOffersLast30Days->fetch_assoc()) {
    array_push($lineDataPoints, array("label" =>  $row['date(creation_date)'], "y" => $row['COUNT(*)']));
}

//for horizontal bar chart
$horizontalBardataPoints = array();
while ($row = $resultWishlistPerOffer->fetch_assoc()) {
    $offer_id_to_find = $row['offer_id'];
    $resultOfferName = $mysqli->query("SELECT name FROM offers WHERE offer_id='" .  $offer_id_to_find . "' ") or die($mysqli->error);
    while ($offer =  $resultOfferName->fetch_assoc()) {
        $offer_name = $offer['name'];
    }

    array_push($horizontalBardataPoints, array("label" => $offer_name, "y" => $row['COUNT(*)']));
}

?>

<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->

    <link href="../../css/general.css?v=1.0" rel="stylesheet" type="text/css" />
    <link href="../../css/vendorHomepage.css?v=1.0" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../../css/headFoot.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript">
    </script>
    <script src="https://kit.fontawesome.com/90569433a0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <!-- tab view -->
    <link rel="shortcut icon" href="../../assets/img/tab_logo.png" type="image/png">
    <title> Marry Me</title>
    <!-- general fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700&amp;display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&family=Josefin+Sans:wght@500&family=Niconne&display=swap"
        rel="stylesheet">

    <!-- numbers font -->
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">


    <script>
    window.onload = function() {
        // Wrap every letter in a span - offers number
        var textWrapper = document.querySelector('.num-of-offers .letters');
        textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

        anime.timeline({
                loop: false
            })
            .add({
                targets: '.num-of-offers .letter',
                translateY: ["1.1em", 0],
                translateZ: 0,
                duration: 3000,
                delay: (el, i) => 50 * i
            }).add({
                targets: '.ml6',
                opacity: 0,
                duration: 1000,
                easing: "easeOutExpo",
                delay: 1000
            });

        //pie chart 
        var pieChart = new CanvasJS.Chart("pieChartContainer", {
            theme: "light2",
            animationEnabled: true,
            exportEnabled: true,
            title: {
                text: "My Offers"
            },
            subtitles: [{
                text: "<?php echo date("l jS \of F Y "); ?>"
            }],
            data: [{
                type: "pie",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($pieDataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        pieChart.render();

        //bar chart
        CanvasJS.addColorSet("columnShades",
            [ //colorSet Array

                "#ffa366",
                "#80e5ff"

            ]);

        var barChart = new CanvasJS.Chart("barChartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light2",
            colorSet: "columnShades",
            title: {
                text: "Mention of Offers in Wishlists"
            },
            axisY: {
                includeZero: true
            },
            data: [{
                type: "column",
                indexLabel: "{y}", //Shows y value on all Data Points
                indexLabelFontColor: "#5A5757",
                indexLabelPlacement: "outside",
                dataPoints: <?php echo json_encode($barDataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        barChart.render();

        //line chart
        var lineChart = new CanvasJS.Chart("lineChartContainer", {
            theme: "light2",
            animationEnabled: true,
            exportEnabled: true,
            title: {
                text: "Last Month offers "
            },
            axisY: {
                title: "number of offers"
            },
            data: [{
                type: "spline",
                dataPoints: <?php echo json_encode($lineDataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });

        lineChart.render();

        //horizontal bar chart
        var horizontalBarchart = new CanvasJS.Chart("horizontalBarChartContainer", {
            theme: "light2",
            animationEnabled: true,
            exportEnabled: true,
            title: {
                text: "Offers in Wishlists"
            },
            axisY: {
                title: "number of references in wishlists",
                includeZero: true,

            },
            data: [{
                type: "bar",
                indexLabel: "{y}",
                indexLabelPlacement: "inside",
                indexLabelFontWeight: "bolder",
                indexLabelFontColor: "white",
                dataPoints: <?php echo json_encode($horizontalBardataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        horizontalBarchart.render();

    }
    </script>

</head>

<body>

    <header id="nav">
        <?php include('../navbarTemplate.php') ?>
    </header>


    <div class="header">
        <div class="img-holder typographyH1" data-image="../../assets/img/parallax_vendor_homepage.png">
        </div>
        <div>
            <h1 class="head-text typographyH1">Vendor Homepage</h1>
        </div>
    </div>

    <div class="dashboard">
        <div class="num-of-offers">
            <span class="text-wrapper">
                <span class="letters"><?php echo $offersCount ?></span>
            </span>
            <p>Total Offers</p>
        </div>
        <div id="pieChartContainer"></div>
        <div id="barChartContainer"></div>
        <div id="lineChartContainer"></div>
        <div id="horizontalBarChartContainer"></div>
    </div>

    <div class="short-valid-offers">
        <?php
        if ($offersCountExpireInAWeek > 1 || $offersCountExpireInAWeek == 0) {
            echo  "<h2>You have <span> $offersCountExpireInAWeek </span> Offers that are about to expire
            <hr>
        </h2>";
        } else {
            echo  "<h2>You have <span> $offersCountExpireInAWeek </span> Offer that is about to expire
            <hr>
        </h2>";
        }

        if ($offersCountExpireInAWeek > 0) {

            //print offers
            while ($rowOffersExpireInAWeek = $resultOffersExpireInAWeek->fetch_assoc()) : ?>

        <div>
            <h3><?php echo $rowOffersExpireInAWeek['name'] ?></h3>
            <p><i class="far fa-calendar-alt"></i>
                <?php echo $rowOffersExpireInAWeek['valid_date'] ?></p>
            <hr>
        </div>

        <?php
            endwhile;
        } ?>

        <div class="d-flex justify-content-center">
            <button type="button" id="manage-offers" onclick="location.href = 'offers.php';"
                class="btn btn-info pr-5 pl-5">Manage offers</button>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://rawgithub.com/pederan/Parallax-ImageScroll/master/jquery.imageScroll.min.js"
        type="text/javascript"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="../general.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

</body>

</html>