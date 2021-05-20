<?php require_once('../../conection/init.php');
global $session;
global $database;
$role = $_SESSION['role'];
$one_n = "My Tasks";
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

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="../../assets/img/tab_logo.png" type="image/png">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript">
    </script>
    <script src="https://kit.fontawesome.com/90569433a0.js" crossorigin="anonymous"></script>

    <!-- BS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>

    <!-- tab view -->
    <link rel="shortcut icon" href="../../assets/img/tab_logo.png" type="image/png">
    <title> Marry Me - Wishlist</title>
    <!-- general fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&family=Josefin+Sans:wght@500&family=Niconne&display=swap" rel="stylesheet">
    <link href="../../css/general.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../../css/wishList.css">

    <script>
        function disableBtn(id) {
            var btnSendEmail = document.getElementById(id);
            btnSendEmail.innerHTML = 'you sent email';
            btnSendEmail.disabled = true;
        }
    </script>


</head>

<body>
    <header class="fixed-top" id="nav">
        <?php include('../navbarTemplate.php') ?>
    </header>

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
                            <ul class="infolist">
                                <li class="infolistitem">
                                    <h2><?php echo $offer->name ?></h2>
                                </li>
                                <li class="infolistitem">
                                    <h3><?php echo $vendor->company_name ?></h3>
                                </li>
                                <li class="infolistitem">
                                    <p><?php echo $offer->price ?>&#8362;</p>
                                </li>
                            </ul>

                            <div class="description">
                                <hr>
                                <p><?php echo $offer->description ?></p>
                            </div>
                        </div>

                        <div class="controls">
                            <p>Get Offer</p>
                            <?php if ($wishlist[$i]->is_contact_supplier == '0') : ?>
                                <a href="update_wishList.php?id=<?php echo $wishlist[$i]->whistlist_id; ?>&wishlist=<?php echo $wishlist[$i]->is_contact_supplier; ?>&vendor_email=<?php echo $vendor->email; ?>&offer_name=<?php echo $offer->name; ?>"><button class="btn btn-primary" id="sendEmailBtn<?php echo $i ?>">send
                                        email</button>
                                </a>
                            <?php else : ?>
                                <button type="button" class="btn btn-success offerDisabled" disabled id="sendEmailBtn<?php echo $i ?>">Already
                                    sent</button>

                            <?php endif ?>

                            <a href="delet_wishList.php?id=<?php echo $wishlist[$i]->whistlist_id; ?>" class="btn trash-span mx-2 mt-2 " style="color:#b12531;"> <i class="fas fa-trash"></i></a>

                        </div>


                    </div>
            <?php
                }
            }
            ?>
        </section>
    </main>

    <footer>
        <?php include('../footer.php') ?>
    </footer>

    <!-- Necessary scripts-->
    <script src="https://rawgithub.com/pederan/Parallax-ImageScroll/master/jquery.imageScroll.min.js" type="text/javascript"></script>
    <script src="../general.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>



</body>

</html>