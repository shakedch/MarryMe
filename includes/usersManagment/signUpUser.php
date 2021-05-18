<?php
//conection to all class
require_once('../../conection/init.php');
global $session; //Makes class variables global for use on each page
$error = '';
//if user make Registration 
if (isset($_POST['submit'])) {
    if ($_POST) {
        $error1 = NULL;
        $error2 = NULL;
        $user = new User(); // Create an empty object
        $vendor = new Vendor(); // Create an empty object
        $error1 = $user->find_email($_POST['email']); //A function that aims to check that there is no registered email like the email that the new customer entered
        $error2 = $vendor->find_email($_POST['email']); //A function that aims to check that there is no registered email like the email that the new customer entered
        // added code 09.05.2021
        $date_of_wedding = $_POST['date_of_wedding'];
        $changeDate = date("Y-m-d", strtotime($date_of_wedding));
        $today = date("Y-m-d");
        if ($changeDate < $today) {
            header("location: ../usersManagment/signUpUser.php?dateError");
            exit();
        }
        // end of added code
        if ($error1 == null && $error2 == null) { // If there is no email already registered
            //Function for adding a user
            $error = user::add_user($_POST['email'], $_POST['password'], $_POST['full_name1'], $_POST['full_name2'], $_POST['date_of_wedding'], $_POST['hour_of_wedding'], $_POST['budget']);
            echo '<script>alert("User was Created")</script>';
            header('Location: login.php');
        } else {
            //If the function found a registered email already
            echo '<script>alert("The email you entered is already in use")</script>';
            $error = 'The email you entered is already in use';
        }
    } else {
        // if user make Registration but there was a error
        $error = 'something is worng';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript">
    </script>
    <script src="https://kit.fontawesome.com/90569433a0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- BS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <!-- BS -->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <!-- tab view -->
    <link rel="shortcut icon" href="../../assets/img/tab_logo.png" type="image/png">
    <title> Registration Couple</title>
    <!-- general fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700&amp;display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&family=Josefin+Sans:wght@500&family=Niconne&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="../../css/general.css" />
    <link rel="stylesheet" href="../../css/signUp.css" />
</head>

<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card registerForm-card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <img src="../../assets/img/signUpUser.jpg" alt="registerForm" class="registerForm-card-img">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <p class="registerForm-card-description">Registration For The Happy Couple</p>
                            <!-- form for log in  -->
                            <form method="post">
                                <div class="form-group">
                                    <input class="form-control" type="email" placeholder="Example@gmail.com"
                                        name="email" required>
                                </div>
                                <div class="form-group mb-4">
                                    <input class="form-control" type="password" placeholder="password" name="password"
                                        required>
                                </div>
                                <div class="form-group mb-4">
                                    <input class="form-control" type="text" placeholder="Enter first full name"
                                        name="full_name1" required>
                                </div>
                                <div class="form-group mb-4">
                                    <input class="form-control" type="text" placeholder="Enter second full name"
                                        name="full_name2" required>
                                </div>
                                <div class="form-group mb-4">
                                    <input class="form-control" type="date" placeholder="Enter Wedding Date"
                                        name="date_of_wedding" required>
                                </div>
                                <div class="form-group mb-4">
                                    <input class="form-control" type="time" placeholder="Enter hour of wedding"
                                        name="hour_of_wedding" required>
                                </div>
                                <div class="form-group mb-4">
                                    <input class="form-control" type="text" placeholder="What is your budget?"
                                        name="budget" required>
                                </div>
                                <p id="error"><?php echo $error ?></p>
                                <input class="btn btn-block registerForm-btn mb-4" type="submit" name="submit"
                                    value="Registration">
                            </form>
                            <p> Already have an account? <a href="login.php">Sign-In</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- added code 9/5/2021 -->
    <?php
    if (isset($_GET["dateError"])) {
        echo "<script> alert('impossible date');</script>";
    }
    ?>
    <!-- end of code -->


    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>