<?php require_once('../../conection/init.php');
global $session;
global $database;
$role = $_SESSION['role'];
$one_n = "My Task";
$sec_n = "Market";
$thr_n = "wishlist";
$inout = "Log Out";
$SeeCre = "See Your Account";
$where0 = "../tasksProcess/tasks.php";
$where3 = "../marketAndOffers/market.php";
$where1 = "../usersManagment/logOut.php";
$where2 = "../usersManagment/myAccount.php";
$where4 = "wishList.php";
$user = new User();
$user->find_user_by_id($session->id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/wishList.css">
    <link rel="stylesheet" type="text/css" href="../../css/headFoot.css">
    <link rel="shortcut icon" href="../../assets/img/tab_logo.png" type="image/png">
    <link href="../../css/general.css?v=1.0" rel="stylesheet" type="text/css" />
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
                <span class="navbar-text text-black"><?php echo $user->full_name1; ?> &
                    <?php echo $user->full_name2; ?></span>
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

    <div class="header">
        <div class="img-holder" data-image="../../assets/img/parallax_wishlist.png">
        </div>
        <div>
            <h1 class="head-text typographyH1">Wish list</h1>
        </div>
    </div>

    <main>
        <section class="offer-list">

            <?php
      $wishlist = wishtlist::fetch_wishtlist($session->id);
      if (!isset($wishlist)) {
        echo "there are no product";
      } else {
        for ($i = 0; $i < sizeof($wishlist); $i++) {
          $offer = new offer();
          $offer->find_my_offer($wishlist[$i]->offer_id);
          $vendor = new Vendor();
          $vendor->find_user_by_id($wishlist[$i]->vendor_id);

      ?>

            <div class="offer">
                <!-- Uploading photo -->
                <div class="image">
                    <?php echo
              "<img src='../../assets/img/offersUploads/" . (($offer->img == '') || ($offer->img == '.') ? 'no-image-available.png' : $offer->img) . "' />";
              ?>
                </div>


                <div class="info">
                    <ul>
                        <li>
                            <h3><?php echo $offer->name ?></h3>
                        </li>
                        <li>
                            <h2><?php echo $vendor->company_name ?><h2>
                        </li>
                        <li>
                            <h2><?php echo $offer->price ?>&#8362;</h2>
                        </li>
                    </ul>

                    <div class="description">
                        <p><?php echo $offer->description ?></p>
                    </div>
                </div>

                <div class="controls">
                    <p>Get Offer</p>
                    <button><a href="update_wishList.php?id=<?php echo $wishlist[$i]->whistlist_id; ?>">send
                            email</a></button>
                    <a href="delet_wishList.php?id=<?php echo $wishlist[$i]->whistlist_id; ?>"><img class="trash-span"
                            src="https://img.icons8.com/carbon-copy/100/000000/delete--v1.png" width="50px" /></a>

                </div>


            </div>
            <?php
        }
      }
      ?>
        </section>
    </main>

    <!-- Necessary scripts-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://rawgithub.com/pederan/Parallax-ImageScroll/master/jquery.imageScroll.min.js"
        type="text/javascript"></script>
    <script src="../general.js"></script>



</body>

</html>