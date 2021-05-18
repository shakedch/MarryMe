<?php
require_once '../../conection/init.php';
require_once 'offersProcess.php';

global $session;
global $database;
$role = $_SESSION['role'];
$one_n = "Offers";
$inout = "Log Out";
$SeeCre = "See Your Account";
$where0 = "offers.php";
$where1 = "../usersManagment/logOut.php";
$where2 = "../usersManagment/myAccount.php";
$vendor = new Vendor();
$vendor->find_user_by_id($session->id);
?>


<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->

    <link href="../../css/general.css?v=1.0" rel="stylesheet" type="text/css" />
    <link href="../../css/offers.css?v=1.0" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../../css/headFoot.css">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript">
    </script>
    <script src="https://kit.fontawesome.com/90569433a0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <!-- tab view -->
    <link rel="shortcut icon" href="../../assets/img/tab_logo.png" type="image/png">
    <title> Marry Me</title>
    <!-- general fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&family=Josefin+Sans:wght@500&family=Niconne&display=swap" rel="stylesheet">

</head>

<body>

    <header id="nav">
        <?php include('../navbarTemplate.php') ?>
    </header>

    <div class="header">
        <div class="img-holder" data-image="../../assets/img/parallax_offers.png">
        </div>
        <div>
            <h1 class="head-text typographyH1">Offers</h1>
        </div>
    </div>

    <div class="container">
        <?php if (isset($_SESSION['message'])) : ?>
            <div class="alert alert-<?= $_SESSION['msg_type'] ?> ">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif ?>
        <form name="search_form" action="offers.php" id="search_form" method="POST">
            <input type="text" id="offer_name" name="offer_name" placeholder="search offer">
            <button type="submit" name="search" class="btn btn-primary"><i class="fa fa-search"></i></button>
            <button type="submit" name="all_offers" class="btn btn-outline-primary">show all my offers</button>
        </form>
        <hr>

        <?php
        $mysqli = new mysqli("localhost", "root", "", "marryme") or die(mysqli_error(($mysqli)));
        $offer_name = '';

        function offer_name_to_find()
        {
            $offer_name = $_POST["offer_name"];
            return $offer_name;
        }
        if (isset($_POST['search'])) {
            $offer_name = offer_name_to_find();
        }

        if (isset($_POST['all_offers'])) {
            $offer_name = '';
        }

        if ($offer_name === '') {
            $result = $mysqli->query("SELECT * FROM offers WHERE vendor_id='" . $session->id . "' ") or die($mysqli->error);
        } else {
            $result = $mysqli->query("SELECT * FROM offers WHERE vendor_id='" . $session->id . "' AND name LIKE '%" . $offer_name . "%'") or die($mysqli->error);
        }

        if (mysqli_num_rows($result) < 1) {
            echo "<div class='no-offers'><h3> OFFERS NOT YET BEEN ADDED </h3><p>please add new offers.... </p></div><hr>";
        }
        ?>


        <div class="row justify-content-center">


            <?php
            while ($row = $result->fetch_assoc()) : ?>

                <div class="card mb-3 offers " style="width: 80%;">
                    <div class="row">

                        <div class="col-3 my-auto"><?php
                                                    echo
                                                    "<td class='photoUpload'><img class='centerPic' src='../../assets/img/offersUploads/" . (($row["img"] == '') || ($row["img"] == '.') ? 'no-image-available.png' : $row["img"]) . "' align='center' height='65' /></td>";
                                                    ?><br></div>
                        <div class="col-7">
                            <h2 class="card-title"><?php echo $row['name'] ?></h2>
                            <p class="card-text">&#8362;<?php echo $row['price'] ?></p>
                            <p class="card-text"><small class="text-muted">
                                    <?php echo $row['description'] ?>
                                </small></p>
                        </div>

                        <div class="col-2 text-right mt-2 ">
                            <a href="offersProcess.php?delete=<?php echo $row['offer_id']; ?>" class="btn btn-danger"> <i class="fas fa-trash"></i></a>
                            <a href="offers.php?edit=<?php echo $row['offer_id']; ?>" class="btn btn-info"> <i class="fas fa-edit"></i></a>
                        </div>
                    </div>
                </div>

            <?php endwhile; ?>
        </div>
    </div>


    <dialog id="myDialog">

        <button id="close" onclick="parent.location='offers.php'">&#10008;</button>
        <h3>Add New Offer</h3>
        <div class="row pr-5 pl-5 ">
            <form name="offers_form" action="offersProcess.php" id="offers_form" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="offer_id" value="<?php echo $offer_id; ?>">

                <div class="form-group ">
                    <lable>offer name</lable>
                    <input type="text" id="name" name="name" class="form-control" maxlength="55" value="<?php echo $name; ?>" placeholder="Enter the offer name">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>

                <div class="form-group">
                    <lable>valid date</lable>
                    <input type="datetime-local" id="valid_date" name="valid_date" class="form-control" value="<?php echo $valid_date; ?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>

                <div class="form-group">
                    <lable>description</lable>
                    <input type="text" id="description" name="description" class="form-control" maxlength="255" placeholder="Enter the description of the offer" value="<?php echo $description; ?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>

                <div class="form-group ">
                    <lable>price</lable>
                    <input type="text" id="price" name="price" class="form-control" maxlength="255" min="1" placeholder="XXX &#8362;" value="<?php echo $price; ?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>

                <div class="form-group">
                    <lable>relevant image</lable>
                    <input type="file" id="img" name="img" class="form-control" accept="image/png, image/jpeg" placeholder="Enter a relevant image for the offer" multiple value="<?php echo $img; ?>">

                </div>

                <div class="form-group">
                    <?php
                    if ($update == true) : ?>

                        <button type="submit" name="update" class="btn btn-info">Update</button>
                    <?php
                    else : ?>
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <?php
                    endif; ?>
                </div>

            </form>

        </div>
        <button onclick="parent.location='offers.php'" class="btn btn-secondary">Close</button>

    </dialog>

    <button class="add-offer" onclick="window.dialog.showModal();">+</button>
    <script>
        if ((window.location.href).includes("edit")) document.getElementById("myDialog").showModal();
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://rawgithub.com/pederan/Parallax-ImageScroll/master/jquery.imageScroll.min.js" type="text/javascript"></script>
    <script src="../general.js"></script>
    <script src="offers.js"></script>

</body>

</html>