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
$where1 = "../usersManagment/LogOut.php";
$where2 = "../usersManagment/My_Account.php";
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

    <link rel="stylesheet" type="text/css" href="../../css/HeadFoot.css">
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
            </ul>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="mx-auto"></div>
                <span class="navbar-text text-black"><?php echo $user->company_name; ?></span>
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
        <div class="img-holder" data-image="../../assets/img/parallax_vendor.png">
        </div>
        <div>
            <h1 class="head-text typographyH1 ">Vendor Details</h1>
            <!--במקום ונדור לשים את שם הספק שנלחץ לוודא שבלחיצה מועבר הערך הזה-->
        </div>
    </div>
    <div class="container">
        <?php
        $mysqli = new mysqli("localhost", "root", "", "marryme") or die(mysqli_error(($mysqli)));
        $result = $mysqli->query("SELECT * FROM vendors WHERE vendor_id=$vendor_id ") or die($mysqli->error); // נצטרך לעשות תנאי של מתי שהספק שווה הספק שנשלח בלחיצה
        ?>

        <div class="d-flex justify-content-around info">

            <?php
            while ($row = $result->fetch_assoc()) : ?>
                <div class="vendor_info">
                    <h2><?php echo $row['company_name'] ?>
                        <hr>
                    </h2>
                    <h3>Email</h3>
                    <p><?php echo $row['email'] ?></p>
                    <h3>Phone</h3>
                    <p><?php echo $row['phone_num'] ?></p>
                    <h3>Business type</h3>
                    <p> <?php echo $row['kind_of_business'] ?></p>
                    <h3>Website</h3> <a href=" <?php echo $row['web_url'] ?>"> <?php echo $row['company_name'] ?></a>
                </div>
                <div class="vendor_address">
                    <?php
                    $address = $row['address'];
                    ?>
                    <script>
                        alert($address);
                    </script>
                    <?php $address = str_replace(" ", "+", $address); ?>
                    <iframe width="350" height="350" src="https://map.google.com/maps?q=<?php echo
                                                                                        $address; ?>&output=embed"></iframe>
                </div>
            <?php endwhile; ?>

        </div>
        <hr>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://rawgithub.com/pederan/Parallax-ImageScroll/master/jquery.imageScroll.min.js" type="text/javascript"></script>
    <script src="../general.js"></script>
    <script src="offers.js"></script>

</body>

</html>