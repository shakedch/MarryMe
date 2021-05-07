<?php
require_once('../../conection/init.php');
require_once('../tasksProcess/insertAndDelete.php');
global $session;
$role = $_SESSION['role'];
$one_n = "My_Task";
$sec_n = "Market";
$thr_n = "My Offer";
$inout = "Log Out";
$SeeCre = "See Your Account";
$where0 = "../tasksProcess/tasks.php";
$where1 = "../usersManagment/LogOut.php";
$where2 = "../usersManagment/My_Account.php";
$where3 = "../marketAndOffers/market.php";
$where4 = "../my_OFFER/offer_wish.php";
$mysqli = new mysqli("localhost", "root", "", "marryme") or die(mysqli_error(($mysqli)));
$chart_query = "SELECT status, count(*) as number FROM tasks WHERE user_id ='" . $session->id . "' GROUP BY status ";
$result = mysqli_query($mysqli, $chart_query);
$user = new User();
$user->find_user_by_id($session->id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- BS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <!-- BS -->
    <!--jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!--jQuery -->
    <!-- Icons -->
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <!-- Icons -->
    <!-- general fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700&amp;display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&family=Josefin+Sans:wght@500&family=Niconne&display=swap"
        rel="stylesheet" />
    <!-- general fonts-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript">
    </script>
    <script src="https://kit.fontawesome.com/90569433a0.js" crossorigin="anonymous"></script>

    <!-- our import files -->
    <link rel="stylesheet" type="text/css" href="../../css/HeadFoot.css">
    <link rel="stylesheet" href="../../css/general.css" />
    <link rel="stylesheet" href="../../css/coupleHomepage.css" />


    <!-- our import files -->
    <!-- tab view -->
    <link rel="shortcut icon" href="../../assets/img/tab_logo.png" type="image/png" />
    <!-- tab view -->
    <title>MarryMe-Homepage</title>
    <!-- google chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Status', 'Number'],
            <?php
                while ($row = mysqli_fetch_array($result)) {
                    echo "['" . $row["status"] . "', " . $row["number"] . "],";
                }
                ?>
        ]);
        var options = {
            title: 'Your Tasks Status',
            //is3D:true,  
            pieHole: 0.4
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
    </script>
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
                <li class="nav-item">
                    <a class="nav-link text-black" href="<?php echo $where3 ?>"><?php echo $sec_n ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black" href="<?php echo $where4 ?>"><?php echo $thr_n ?></a>
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
    <!-- img-header -->
    <div class="header">
        <div class="img-holder" data-image="../../assets/img/parallax_coupleHP.jpg"></div>


        <div>
            <h1 class="head-text typographyH1 coupleHPTitle">
                The wedding of <br />
                <span class="coupleHPTitle"><?php echo $user->full_name1; ?></span> &
                <span class="coupleHPTitle"><?php echo $user->full_name2; ?></span>
            </h1>
        </div>
    </div>
    <!-- wedding countdown-->
    <?php
    $weddingDate = $user->date_of_wedding;
    $weddingHour = $user->hour_of_wedding;
    $combinedDT = $weddingDate . ' ' . $weddingHour;
    date_default_timezone_set('UTC');
    $now = date("Y-m-d H:i:s");
    ?>
    <script>
    var countDownDate = <?php
                            echo strtotime("$combinedDT") ?> * 1000;
    var now = <?php echo strtotime("$now") ?> * 1000;

    // Update the count down every 1 second
    var x = setInterval(function() {
        now = now + 1000;
        // Find the distance between now an the count down date
        var distance = countDownDate - now;
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        // Output the result in an element with id="demo"
        document.getElementById("countdown").innerHTML = days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";
        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "Time To Celebrate";
        }

    }, 1000);
    </script>

    <div class="countdownWrraper">
        <h2>Time to Wedding!</h2>
        <p class="countdown" id="countdown"></p>
    </div>

    <!-- task status Chart-->
    <br /><br />
    <div style="width:900px;">
        <h4>Tasks status view:</h4>
        <br />
        <div id="piechart" style="width: 900px; height: 500px;"></div>
    </div>

    <!-- budget bar-->
    <br /><br />
    <?php
    $budget = $user->budget;
    $cost = "SELECT SUM(cost) FROM tasks WHERE user_id='" . $session->id . "'";
    $temp = mysqli_query($mysqli, $cost);
    $total = mysqli_fetch_array($temp);
    $total_cost = $total["SUM(cost)"];
    $precent = round(($total_cost / $budget) * 100, 3);
    //check calculation
    // echo "<p>$total_cost is $precent% of $budget </p>";
    ?>

    <br /><br />
    <h4>Budget bar:</h4>
    <label for="file">File progress:</label>
    <progress value="<?php echo $precent ?>" max="100"></progress>
    <?php echo "<p>$precent%</p>" ?>

    <!-- budget bar-->

    <br /><br />

    <?php
    $res = "SELECT COUNT(task_id) FROM tasks WHERE due_date < '" . $now . "' AND user_id='" . $session->id . "' AND status != 'Completed'";
    $temp = mysqli_query($mysqli, $res);
    $res1 = mysqli_fetch_array($temp);
    $total_task = $res1["COUNT(task_id)"];



    $num = 1;
    $res2 = "SELECT COUNT(task_id) FROM tasks WHERE DATEDIFF(due_date,CURDATE()) = $num AND user_id='" . $session->id . "' AND status != 'Completed'";
    $temp1 = mysqli_query($mysqli, $res2);
    $res3 = mysqli_fetch_array($temp1);
    $total_task2 = $res3["COUNT(task_id)"];
    ?>


    <div class="updates">
        <h3>Pay Attention:</h3>
        <p>You have <span> <?php echo $total_task ?> </span> tasks that their due date has passed.</p>
        <p>You have <span> <?php echo $total_task2 ?> </span> tasks to do coming soon.</p>

    </div>




    <!-- Necessary scripts-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://rawgithub.com/pederan/Parallax-ImageScroll/master/jquery.imageScroll.min.js"
        type="text/javascript"></script>
    <script src="../general.js"></script>
</body>

</html>