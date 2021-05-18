<?php require_once '../../conection/init.php';
global $session;
global $database;
$role = $_SESSION['role'];
$one_n = "My_Task";
$sec_n = "Market";
$thr_n = "wishlist";
$inout = "Log Out";
$SeeCre = "See Your Account";
$where0 = "../tasksProcess/tasks.php";
$where3 = "market.php";
$where1 = "../usersManagment/logOut.php";
$where2 = "../usersManagment/myAccount.php";
$where4 = "../wishList/wishList.php";
$user = new User();
$user->find_user_by_id($session->id);


if (isset($_POST['send_vendor'])) {

    $vendor_id = $_POST['vendor_id'];


    //header("location: offers.php");
}

?>
<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />

    <link rel="stylesheet" type="text/css" href="../../css/headFoot.css">
    <link rel="stylesheet" type="text/css" href="../../css/general.css" />
    <link rel="stylesheet" type="text/css" href="../../css/vendorDetails.css" />
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
    <link
        href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&family=Josefin+Sans:wght@500&family=Niconne&display=swap"
        rel="stylesheet">

    <!-- Gallery Swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>

<body>
    <header id="nav">
        <?php include('../navbarTemplate.php') ?>
    </header>

    <div class="header">
        <div class="img-holder" data-image="../../assets/img/parallax_vendor.png">
        </div>
        <div>
            <h1 class="head-text typographyH1 ">Vendor Details</h1>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <button type="button" onclick="location.href = 'market.php';" class="btn btn-outline-info pr-5 pl-5">Back To
            Market</button>
    </div>

    <div class="container">
        <?php
        $mysqli = new mysqli("localhost", "root", "", "marryme") or die(mysqli_error(($mysqli)));
        $result = $mysqli->query("SELECT * FROM vendors WHERE vendor_id=$vendor_id ") or die($mysqli->error);
        $resultOffers = $mysqli->query("SELECT * FROM offers WHERE vendor_id=$vendor_id AND valid_date>NOW() ") or die($mysqli->error);
        ?>

        <div class="d-flex justify-content-around info">

            <?php
            while ($row = $result->fetch_assoc()) : ?>
            <div class="vendor_info">
                <h2><?php echo $row['company_name'] ?>
                    <hr>
                </h2>
                <h3>Email</h3>
                <p> <i class="far fa-envelope"></i>
                    <?php echo $row['email'] ?></p>
                <h3>Phone</h3>
                <p><i class="fas fa-phone-square-alt"></i>
                    <?php echo $row['phone_num'] ?></p>
                <h3>Business type</h3>
                <p> <i class="far fa-address-card"></i>
                    <?php echo $row['kind_of_business'] ?></p>
                <h3>Website</h3><i class="fa fa-laptop"></i> <a href=" <?php echo $row['web_url'] ?>">
                    <?php echo $row['company_name'] ?></a>
            </div>
            <div class="vendor_address">
                <?php
                    $address = $row['address'];
                    ?>
                <script>
                alert($address);
                </script>
                <?php $address = str_replace(" ", "+", $address); ?>
                <iframe width="350" height="350"
                    src="https://map.google.com/maps?q=<?php echo
                                                                                        $address; ?>&output=embed"></iframe>
            </div>
            <?php endwhile; ?>

        </div>
        <hr>
    </div>


    <h2 id='vendor-offers'>Offers Of This Vendor</h2>

    <!--Gallery Swiper -->

    <div class="swiper-container mySwiper">
        <div class="swiper-wrapper">
            <?php while ($rowOffers = $resultOffers->fetch_assoc()) : ?>
            <div class="swiper-slide">
                <?php
                    echo
                    "<td class='photoUpload'><img class='card-img-top' src='../../assets/img/offersUploads/" . (($rowOffers["img"] == '') || ($rowOffers["img"] == '.') ? 'no-image-available.png' : $rowOffers["img"]) . "' align='center' /></td>";
                    ?>
                <h3><?php echo $rowOffers["name"] ?></h3>
                <p>&#8362;<?php echo $rowOffers["price"] ?></p>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>

    <?php
    //check if to display loop of offers
    if (mysqli_num_rows($resultOffers) > 3) {
        $loop = true;
    } else {
        $loop = false;
    }
    ?>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://rawgithub.com/pederan/Parallax-ImageScroll/master/jquery.imageScroll.min.js"
        type="text/javascript"></script>
    <script src="../general.js"></script>
    <script src="offers.js"></script>

    <!-- Gallery Swiper -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
    var is_loop = "<?php print($loop); ?>";

    var swiper = new Swiper(".mySwiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
        },
        pagination: {
            el: ".swiper-pagination",
        },

        loop: is_loop
    });
    </script>

</body>

</html>