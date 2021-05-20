<?php
//conection to all class
require_once('conection/init.php');
global $session;  //Makes class variables global for use on each page
// if there are a session ( if user or vendor are make log in)
if ($session->signed_in) {

    $role = $_SESSION['role'];
    $temp = 'couple';
    if ($role == $temp) {
        // for navbar for user
        $one_n = "My Task";
        $sec_n = "Market";
        $thr_n = "wishlist";
        $inout = "Log Out";
        $SeeCre = "See Your Account";
        $where0 = "includes/tasksProcess/tasks.php";
        $where1 = "includes/usersManagment/logOut.php";
        $where2 = "includes/usersManagment/myAccount.php";
        $where3 = "includes/marketAndOffers/market.php";
        $where4 = "includes/wishList/wishList.php";
    } else {
        // for navbar for vendor
        $one_n = "Offers";
        $sec_n = "";
        $thr_n = "";
        $inout = "Log Out";
        $SeeCre = "See Your Account";
        $where0 = "includes/marketAndOffers/offers.php";
        $where1 = "includes/usersManagment/logOut.php";
        $where2 = "includes/usersManagment/myAccount.php";
        $where3 = "#";
        $where4 = "#";
    }
} else {
    // for navbar if there are no log in user or vendor
    $one_n = "";
    $sec_n = "";
    $thr_n = "";
    $role = "Hello Guest";
    $inout = "Sign in";
    $SeeCre = "Create New Account";
    $where0 = "#";
    $where1 = "includes/usersManagment/login.php";
    $where2 = "includes/usersManagment/signUp.php";
    $where3 = "#";
    $where4 = "#";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstra4.5.2/css/bootstrap.min.css"> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript">
    </script>
    <script src="https://kit.fontawesome.com/90569433a0.js" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.css" integrity="sha512-ENnX3mn8eIEmPp8XJ30lCs82Ux76IHv3ZeK9Z4TGzmBDEyYmYodgeqFIw7207m3f1Lhl9t1nMzPxHF6p+YD5Pw==" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- general fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&family=Josefin+Sans:wght@500&family=Niconne&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="./assets/img/tab_logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="./css/hpStyle.css">
    <link rel="stylesheet" type="text/css" href="./css/general.css">
    <!-- tab view -->
    <link rel="shortcut icon" href="assets/img/tab_logo.png" type="image/png">
    <title> Marry Me</title>


</head>

<body>
    <div class="hpWrapper">
        <!-- navbar by variables -->
        <nav class="navbar sticky-top navbar-expand-lg navbar-light px-2" style="height: inherit;">
            <a class="navbar-brand" href="index.php" style="display: flex;justify-content: center;align-items: center;">
                <img width="45px" src="assets/img/‏‏logo_navbar.png" alt="logo" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $where0 ?>"><?php echo $one_n ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?php echo $where3 ?>"><?php echo $sec_n ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?php echo $where4 ?>"><?php echo $thr_n ?></a>
                    </li>
                </ul>
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

        </nav>

        <?php
        if ($session->signed_in) {
            if ($role == 'couple') {
                // If the object being connected is a user
                header('Location: includes/regularUserHomepage/regularUserHP.php');
            } else {
                // If the object being connected is a vendor
                header('Location: includes/marketAndOffers/vendorHomepage.php');
            }
        } else {
            // If there are no user or vendor that log in
        ?>
            <div class='hpWrapper'>
                <!-- Video -->
                <header>
                    <div class="overlay"></div>
                    <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
                        <source src="./assets/videos/flowers.mp4" type="video/mp4">
                        <source src="./assets/videos/flowers.webm" type="video/mp4">
                    </video>
                    <div class="container2 h-100">
                        <div class="d-flex h-100 text-center align-items-center">
                            <div class="w-100 text-white">
                                <h1 class="display-3"><img style="width:25rem;height:25rem;" src="./assets/img/logo_transparent.png" alt="Logo"></h1>
                                <p class="lead mb-0">Manage you wedding with us!</p>
                            </div>
                        </div>
                    </div>
                </header>
            </div>
            <!-- Out story text -->
            <div class='divWrapper'>
                <div class='aboutUs'>
                    <h2>About us</h2>
                    <p id="ourStoryText"> Marry Me is a website for managing wedding tasks for customers and
                        suppliers.<br>
                        We all know that wedding management is a complex, expensive process and requires in-depth
                        planning.<br>
                        Our platform enables a direct connection between the supplier and the customer in order to
                        enable ongoing task management,
                        While controlling the budget efficiently and conveniently. </p>
                    <br>
                    <h3>Marry Me - Smile all the way to the canopy</h3>
                </div>
            </div>
            <!-- TODO: Some image in full width here -->
            <div class="img-holder" data-image="./assets/img/hp_img_up.png">
            </div>
            <!-- TODO: 3 element :[ offer to regular user , I DO button, offer to vendor user] here -->
            <div class='divWrapper' id='offers'>
                <div class='textOffers'>
                    <div class='textOfferBox'>
                        <h3>Offer to regular user</h3>
                        <ul>
                            <li>Managing tasks and viewing a calendar that centralizes them</li>
                            <br>
                            <li>Managing expense registration for the wedding</li>
                            <br>
                            <li>Manage a list of vendors that the couple is interested in</li>
                        </ul>
                    </div>
                    <div class='textOfferBox'>
                        <h3>Offer to vendor user</h3>
                        <ul>
                            <li>View a list of potential customers</li>
                            <br>
                            <li>Product management, data and location sharing</li>
                            <br>
                            <li>Opportunity to self-advertise on a website dedicated to engaged couples</li>
                        </ul>
                    </div>
                </div>
                <div class='joinUs'>
                    <h3>Will you join us?</h3>
                    <!-- <div class='offerBox'> --><a class='iDoLink' href="./includes/usersManagment/signUp.php" target="_self" rel="noopener noreferrer"><button type="button">I Do!</button></a><!-- </div> -->
                </div>
            </div>
            <!-- TODO: Some image in full width here -->
            <div class="img-holder" data-image="./assets/img/hp_img_down.png">
            </div>

            <footer>
                <?php include('includes/footer.php') ?>
            </footer>

            <!-- Necessary scripts-->
            <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
            <script src="https://rawgithub.com/pederan/Parallax-ImageScroll/master/jquery.imageScroll.min.js" type="text/javascript"></script>
            <script src="./includes/general.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
            </script>
        <?php
        }
        ?>
    </div>


</body>

</html>