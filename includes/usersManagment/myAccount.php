<?php
//conection to all class
require_once('../../conection/init.php');
global $session; //Makes class variables global for use on each page
$role = $_SESSION['role'];
$temp = 'couple';
function dateFormatter($val)
{
    $dateArray = (explode('-', $val));
    $y = $dateArray[0];
    $m = $dateArray[1];
    $d = $dateArray[2];

    $formatted = $d . '-' . $m . '-' . $y;
    return $formatted;
}

function hourFormatter($val)
{
    $hourArray = (explode(':', $val));
    $hour = $hourArray[0];
    $minute = $hourArray[1];


    $formatted = $hour . ':' . $minute;

    return $formatted;
}
if ($role == $temp) {
    // for navbar for user
    $one_n = "My Task";
    $sec_n = "Market";
    $thr_n = "wishlist";
    $inout = "Log Out";
    $SeeCre = "See Your Account";
    $where0 = "../tasksProcess/tasks.php";
    $where1 = "logOut.php";
    $where2 = "myAccount.php";
    $where3 = "../marketAndOffers/market.php";
    $where4 = "../wishList/wishList.php";
    $user = new User();
    $user->find_user_by_id($session->id);
    $whoi = $user->full_name1 . " & " . $user->full_name2;
} else {
    // for navbar for vendor
    $one_n = "Offers";
    $sec_n = "";
    $thr_n = "";
    $inout = "Log Out";
    $SeeCre = "See Your Account";
    $where0 = "../marketAndOffers/offers.php";
    $where1 = "logOut.php";
    $where2 = "myAccount.php";
    $where3 = "#";
    $where4 = "#";
    $vendor = new Vendor();
    $vendor->find_user_by_id($session->id);
    $whoi = $vendor->company_name;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.css"
        integrity="sha512-ENnX3mn8eIEmPp8XJ30lCs82Ux76IHv3ZeK9Z4TGzmBDEyYmYodgeqFIw7207m3f1Lhl9t1nMzPxHF6p+YD5Pw=="
        crossorigin="anonymous" />
    <!-- general fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700&amp;display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&family=Josefin+Sans:wght@500&family=Niconne&display=swap"
        rel="stylesheet">
    <!-- bootstrap for table -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
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
    <!-- css files -->
    <link rel="stylesheet" type="text/css" href="../../css/general.css">
    <link rel="stylesheet" type="text/css" href="../../css/headFoot.css">
    <link rel="stylesheet" type="text/css" href="../../css/myAccount.css">
</head>

<body>

    <header id="nav" style="height: 8rem;">
        <?php include('../navbarTemplate.php') ?>
    </header>

    <?php
    if ($session->signed_in) {
        if ($role == 'couple') {
            $error = '';
            $user = new User(); // Create an empty object
            $error = $user->find_user_by_email($session->email);    // Inserting data into an object		
    ?>

    <!-- table with user data -->
    <div class="userInfoWrapper">
        <div class="panel-body inf-content">
            <div class="row">
                <div class="col-md-5">
                    <img class="imgProfile" alt="" title="" class="img-circle img-thumbnail isTooltip"
                        src="../../assets/img/hp_img_two.jpg" data-original-title="Usuario">
                </div>
                <div class="col-md-6">
                    <strong>Information</strong><br>
                    <div class="table-responsive">
                        <table class="table table-user-information">
                            <tbody>
                                <tr>
                                    <td>
                                        <strong>
                                            <span class="glyphicon glyphicon-user  text-primary"></span>
                                            Full name 1
                                        </strong>
                                    </td>
                                    <td class="text-primary">
                                        <?php echo $user->full_name1; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>
                                            <span class="glyphicon glyphicon-user text-primary"></span>
                                            Full name 2
                                        </strong>
                                    </td>
                                    <td class="text-primary">
                                        <?php echo $user->full_name2; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <strong>
                                            <span class="glyphicon glyphicon-calendar text-primary"></span>
                                            Date of wedding
                                        </strong>
                                    </td>
                                    <td class="text-primary">
                                        <?php echo dateFormatter($user->date_of_wedding); ?>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <strong>
                                            <span class="glyphicon glyphicon-time text-primary"></span>
                                            Hour of wedding
                                        </strong>
                                    </td>
                                    <td class="text-primary">
                                        <?php echo hourFormatter($user->hour_of_wedding); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>
                                            <span class="glyphicon glyphicon-envelope text-primary"></span>
                                            Email
                                        </strong>
                                    </td>
                                    <td class="text-primary">
                                        <?php echo $user->email; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>
                                            <span class="glyphicon glyphicon-exclamation-sign text-primary"></span>
                                            Budget
                                        </strong>
                                    </td>
                                    <td class="text-primary">
                                        <?php echo $user->budget; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- button to change data -->
    <tr>
        <button type="button" class="updateBtn btn btn-info"><a href="updateUser.php">Update your profile >>
            </a></button>
    </tr>
    </tbody>
    </table>
    <!-- <div id="clear"></div> -->
    <?php
        } else {
            $error = '';
            $user = new Vendor(); // Create an empty object
            $error = $user->find_user_by_email($session->email);    // Inserting data into an object	
        ?>
    <!-- table with user data -->
    <div class="userInfoWrapper">
        <div class="panel-body inf-content">
            <div class="row">
                <div class="col-md-5">
                    <img alt="" class="imgProfile" title="" class="img-circle img-thumbnail isTooltip"
                        src="../../assets/img/myAccountVendor.jpg" data-original-title="Usuario">
                </div>
                <div class="col-md-6">
                    <strong>Information</strong><br>
                    <div class="table-responsive">
                        <table class="table table-user-information">
                            <tbody>
                                <tr>
                                    <td class="vendorTD">
                                        <strong>
                                            <span class="glyphicon glyphicon-user  text-primary"></span>
                                            Company name
                                        </strong>
                                    </td>
                                    <td class="text-primary">
                                        <?php echo $user->company_name; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="vendorTD">
                                        <strong>
                                            <span class="glyphicon glyphicon-phone text-primary"></span>
                                            Phone number
                                        </strong>
                                    </td>
                                    <td class="text-primary">
                                        <?php echo $user->phone_num; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="vendorTD">
                                        <strong>
                                            <span class="glyphicon glyphicon-bookmark text-primary"></span>
                                            Kind of business
                                        </strong>
                                    </td>
                                    <td class="text-primary">
                                        <?php echo $user->kind_of_business; ?>
                                    </td>
                                </tr>


                                <tr>
                                    <td class="vendorTD">
                                        <strong>
                                            <span class="glyphicon glyphicon-cloud text-primary"></span>
                                            Web Url
                                        </strong>
                                    </td>
                                    <td class="text-primary">
                                        <?php echo $user->web_url; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="vendorTD">
                                        <strong>
                                            <span class="glyphicon glyphicon-envelope text-primary"></span>
                                            Email
                                        </strong>
                                    </td>
                                    <td class="text-primary">
                                        <?php echo $user->email; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="vendorTD">
                                        <strong>
                                            <span class="glyphicon glyphicon-globe text-primary"></span>
                                            Adress
                                        </strong>
                                    </td>
                                    <td class="text-primary">
                                        <?php echo $user->address; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- button to change data -->
    <button type="button" class="updateBtn btn btn-info"><a href="updateVendor.php">Update your profile >>
        </a></button>
    </tr>
    </tbody>
    </table>
    <?php
        }
    }
    ?>
    </div>

    <!-- Necessary scripts-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://rawgithub.com/pederan/Parallax-ImageScroll/master/jquery.imageScroll.min.js"
        type="text/javascript"></script>
    <script src="general.js"></script>

</body>

</html>