<?php
//conection to all class
require_once('../../conection/init.php');
global $session; //Makes class variables global for use on each page
$error = '';
$vendorDetails = new Vendor();
$vendorDetails->find_user_by_email($session->email);
//if vendor make Update 
if (isset($_POST['submit'])) {
    if ($_POST) {
        $error = NULL;
        $vendor = new Vendor(); // Create an empty object
        // A function for update data
        var_dump($_POST['kind_of_business']);
        $error = $vendor->update_data($session->email, $_POST['company_name'], $_POST['phone_num'], $_POST['kind_of_business'], $_POST['web_url'], $_POST['address']);
        echo '<script>alert("vendor was update")</script>';
        header('Location: myAccount.php');
    } else {
        // if vendor make update but there was a error
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
    <title> Marry Me - Update Profile</title>
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
                        <img src="../../assets/img/updateVendor.jpg" alt="registerForm" class="registerForm-card-img">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <p class="registerForm-card-description">Update Your Profile</p>
                            <!-- form for log in  -->
                            <form method="post">
                                <div class="form-group mb-4">
                                    <input class="form-control" type="text" placeholder="Enter your Company name"
                                        name="company_name" value="<?php echo $vendorDetails->company_name; ?>">
                                </div>
                                <div class="form-group mb-4">
                                    <input class="form-control" type="text" placeholder="phone number"
                                        pattern="[0-9]{10}" name="phone_num"
                                        value="<?php echo $vendorDetails->phone_num; ?>">
                                </div>
                                <div class="form-group mb-4">
                                    <!-- <label for="kind_of_business">update Kind of Business:</label> -->
                                    <select class="form-select" name="kind_of_business" id="kind_of_business">
                                        <option value="Balloons"
                                            <?php if ($vendorDetails->kind_of_business === 'Balloons') echo ' selected="selected"' ?>>
                                            Balloons</option>
                                        <option value="DJ"
                                            <?php if ($vendorDetails->kind_of_business === 'DJ') echo ' selected="selected"' ?>>
                                            DJ</option>
                                        <option value="photographer"
                                            <?php if ($vendorDetails->kind_of_business === 'photographer') echo ' selected="selected"' ?>>
                                            Photographer</option>
                                        <option value="Hall design"
                                            <?php if ($vendorDetails->kind_of_business === 'Hall design') echo ' selected="selected"' ?>>
                                            Hall design</option>
                                        <option value="Designing tables"
                                            <?php if ($vendorDetails->kind_of_business === 'Designing tables') echo ' selected="selected"' ?>>
                                            Designing tables</option>
                                        <option value="seating"
                                            <?php if ($vendorDetails->kind_of_business === 'seating') echo ' selected="selected"' ?>>
                                            Seating</option>
                                        <option value="Catering"
                                            <?php if ($vendorDetails->kind_of_business === 'Catering') echo ' selected="selected"' ?>>
                                            Catering</option>
                                        <option value="Wedding Dresses"
                                            <?php if ($vendorDetails->kind_of_business === 'Wedding Dresses') echo ' selected="selected"' ?>>
                                            Wedding Dresses</option>
                                        <option value="Makeup"
                                            <?php if ($vendorDetails->kind_of_business === 'Makeup') echo ' selected="selected"' ?>>
                                            Makeup</option>
                                        <option value="entertainment show"
                                            <?php if ($vendorDetails->kind_of_business === 'entertainment show') echo ' selected="selected"' ?>>
                                            Entertainment show</option>
                                        <option value="flowers"
                                            <?php if ($vendorDetails->kind_of_business === 'flowers') echo ' selected="selected"' ?>>
                                            Flowers</option>
                                        <option value="Alcohol"
                                            <?php if ($vendorDetails->kind_of_business === 'Alcohol') echo ' selected="selected"' ?>>
                                            Alcohol</option>
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <input class="form-control" type="text" placeholder="Enter your web url"
                                        name="web_url" value="<?php echo $vendorDetails->web_url; ?>">
                                </div>
                                <div class="form-group mb-4">
                                    <input class="form-control" type="text" placeholder="Enter address" name="address"
                                        value="<?php echo $vendorDetails->address; ?>">
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