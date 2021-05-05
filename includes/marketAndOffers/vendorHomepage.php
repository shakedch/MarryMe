<?php
require_once('../../conection/init.php');
require_once('../tasksProcess/insertAndDelete.php');
global $session;
$role = $_SESSION['role'];
$one_n = "Offers";
$inout = "Log Out";
$SeeCre = "See Your Account";
$where0 = "offers.php";
$where1 = "../usersManagment/LogOut.php";
$where2 = "../usersManagment/My_Account.php";




?>

<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->


    <link href="../../css/general.css?v=1.0" rel="stylesheet" type="text/css" />
    <link href="../../css/vendorHomepage.css?v=1.0" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../../css/HeadFoot.css">

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

</head>

<body>

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3">
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
    <hr>
    <hr>

    <div class="header">
        <div class="img-holder typographyH1" data-image="../../assets/img/parallax_vendor_homepage.png">
        </div>
        <div>
            <h1 class="head-text">Vendor Homepage</h1>
        </div>
    </div>


    <?php
  // רק שיהיה סתם דף למעברים
  $mysqli = new mysqli("localhost", "root", "", "marryme") or die(mysqli_error(($mysqli)));
  $result = $mysqli->query("SELECT * FROM wishlist WHERE vendor_id='" . $session->id . "' ") or die($mysqli->error);
  /*כאן נצטרך לעשות תנאי נוסף של להציג רק מי שהסשן של המשתמש הוא הספק המחובר*/
  $error = '';
  $user = new Vendor();
  $error = $user->find_user_by_email($session->email);
  // ככה אני מוציא את הנותונים של הספק, פותח אוביקט חדש שנקרא משתמש ומכניס אליו את כל המשתנים
  ?>

    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">vendor_id</th>
                    <th scope="col">Email</th>
                    <th scope="col">Company_Name</th>
                    <th scope="col">Phone_Num</th>
                    <th scope="col">Kind_of_Business</th>
                    <th scope="col">Web_Url</th>
                    <th scope="col">Address</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $user->vendor_id; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->company_name; ?></td>
                    <td><?php echo $user->phone_num; ?></td>
                    <td><?php echo $user->kind_of_business; ?></td>
                    <td><?php echo $user->web_url; ?></td>
                    <td><?php echo $user->address; ?></td>
                </tr>
            </tbody>
        </table>






    </div>
    <!-- לא מצליח לשלוף מהטבלאות הרלוונטיות שליפת פרטים מאופרס ויוזרז -->

    <button onclick="location.href = 'offers.php';">MANAGE MY OFFERS</button>

    kfvfjvjfvf<br>kfvfjvjfvf<br>
    ghgfhgh<br>kfvfjvjfvf<br>
    ghgfhgh<br>kfvfjvjfvf<br>
    ghgfhgh<br>kfvfjvjfvf<br>
    ghgfhgh<br>kfvfjvjfvf<br>
    ghgfhgh<br>kfvfjvjfvf<br>
    ghgfhgh<br>
    ghgfhgh<br>








    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://rawgithub.com/pederan/Parallax-ImageScroll/master/jquery.imageScroll.min.js"
        type="text/javascript"></script>
    <script src="../general.js"></script>



</body>

</html>