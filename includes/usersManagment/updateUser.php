<?php
//conection to all class
require_once('../../conection/init.php');
global $session; //Makes class variables global for use on each page
$error = '';
$userDetails = new User();
$userDetails->find_user_by_email($session->email);


//if user make Update 
if (isset($_POST['submit'])) {
    if ($_POST) {
        $error = NULL;
        $user = new User(); // Create an empty object
        // A function for update data
        $error = $user->update_data($session->email, $_POST['full_name1'], $_POST['full_name2'], $_POST['date_of_wedding'], $_POST['hour_of_wedding'], $_POST['budget']);
        echo '<script>alert("User was update")</script>';
        header('Location: myAccount.php');
    } else {
        // if user make update but there was a error
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
    <title> Update Your Profile</title>
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
                        <img src="../../assets/img/updateUser.jpg" alt="registerForm" class="registerForm-card-img">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <p class="registerForm-card-description">Update Your Profile</p>
                            <!-- form for log in  -->
                            <form method="post">
                                <div class="form-group mb-4">
                                    <input class="form-control" type="text" placeholder="Update first full name"
                                        name="full_name1" value="<?php echo $userDetails->full_name1; ?>">
                                </div>
                                <div class="form-group mb-4">
                                    <input class="form-control" type="text"
                                        value="<?php echo $userDetails->full_name2; ?>"
                                        placeholder="Update second full name" name="full_name2">
                                </div>
                                <div class="form-group mb-4">
                                    <input class="form-control" type="date"
                                        value="<?php echo ($userDetails->date_of_wedding); ?>"
                                        placeholder="Update Wedding Date" name="date_of_wedding">
                                </div>
                                <div class="form-group mb-4">
                                    <input class="form-control" type="time"
                                        value="<?php echo $userDetails->hour_of_wedding; ?>"
                                        placeholder="Update hour of wedding" name="hour_of_wedding">
                                </div>
                                <div class="form-group mb-4">
                                    <input class="form-control" type="text" value="<?php echo $userDetails->budget; ?>"
                                        placeholder="Update your budget" name="budget">
                                </div>
                                <p id="error"><?php echo $error ?></p>
                                <input class="btn btn-block registerForm-btn mb-4" type="submit" name="submit"
                                    value="Update">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>