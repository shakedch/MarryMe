<?php
//conection to all class
require_once('../../conection/init.php');
global $session; //Makes class variables global for use on each page
$error = '';
//if vendor make Registration 
if (isset($_POST['submit'])) {
	if ($_POST) {
		$error1 = NULL;
		$error2 = NULL;
		$user = new User(); // Create an empty object
		$vendor = new Vendor(); // Create an empty object
		$error1 = $user->find_email($_POST['email']); //A function that aims to check that there is no registered email like the email that the new customer entered
		$error2 = $vendor->find_email($_POST['email']); //A function that aims to check that there is no registered email like the email that the new customer entered
		if ($error1 == null && $error2 == null) { // If there is no email already registered
			//Function for adding a vendor
			$error = Vendor::add_Vendor($_POST['email'], $_POST['password'], $_POST['company_name'], $_POST['phone_num'], $_POST['kind_of_business'], $_POST['web_url'], $_POST['address']);
			echo '<script>alert("Vendor was Created")</script>';
			header('Location: login.php');
		} else {
			//If the function found a registered email already
			echo '<script>alert("The email you entered is already in use")</script>';
			$error = 'The email you entered is already in use';
		}
	} else {
		// if vendor make Registration but there was a error
		$error = 'something is worng';
	}
}
?>
<!DOCTYPE html>
<html>

<head>
    <!-- connection css and bootstrap and metadata -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Registration Form for Vendor</title>
    <!-- <link rel="stylesheet" type="text/css" href="../../css/Login.css"> -->
    <link rel="stylesheet" type="text/css" href="../../css/signup.css">

</head>

<body>
    <p id="error"><?php echo $error ?></p>
    <div class="login-box">
        <h1>Registration - Vendors</h1>
        <!-- form for Registration  -->
        <form method="post">
            <div class="textbox">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <input type="email" placeholder="Example@gmail.com" name="email" required>
            </div>
            <div class="textbox">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="Password" placeholder="Password" name="password" required>
            </div>
            <div class="textbox">
                <i class="fa fa-address-card" aria-hidden="true"></i>
                <input type="text" placeholder="Enter your Company name" name="company_name" required>
            </div>
            <div class="textbox">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="text" placeholder="phone number" pattern="[0-9]{10}" name="phone_num" required>
            </div>
            <label for="kind_of_business">Choose Kind of Business:</label>
            <select class="btn" name="kind_of_business" id="kind_of_business">
                <option value="Balloons">Balloons</option>
                <option value="DJ">DJ</option>
                <option value="photographer">Photographer</option>
                <option value="Hall design">Hall design</option>
                <option value="Designing tables">Designing tables</option>
                <option value="seating">Seating</option>
                <option value="Catering">Catering</option>
                <option value="Wedding Dresses">Wedding Dresses</option>
                <option value="Makeup">Makeup</option>
                <option value="entertainment show">Entertainment show</option>
                <option value="flowers">Flowers</option>
                <option value="Alcohol">Alcohol</option>
            </select>
            <div class="textbox"></div>
            <div class="textbox">
                <i class="fa fa-address-card" aria-hidden="true"></i>
                <input type="text" placeholder="Enter your web url" name="web_url" required>
            </div>
            <div class="textbox">
                <i class="fa fa-address-card" aria-hidden="true"></i>
                <input type="text" placeholder="Enter address" name="address" required>
            </div>


            <input class="btn" type="submit" name="submit" value="Registration">
        </form>
        <p> Already have an account? <a href="login.php">Sign-In</a></p>
    </div>
</body>

</html>