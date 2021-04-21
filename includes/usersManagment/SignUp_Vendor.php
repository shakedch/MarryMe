<?php
	require_once('../../conection/init.php');
	if($database->get_connection()){
		echo "connection is OK <br>";
	}
	else{
		die("conncection failed.");
	}
    global $session;
    $error='';
	if(isset($_POST['submit'])){
		if($_POST){
			$error1=NULL;
			$error2=NULL;
			$user = new User();
			$vendor = new Vendor();
			$error1 = $user->find_email($_POST['email']);
			$error2 = $vendor->find_email($_POST['email']);
			if($error1 == null && $error2 == null ){
				$error=Vendor::add_Vendor($_POST['email'],$_POST['password'],$_POST['company_name'],$_POST['phone_num'],$_POST['kind_of_business'],$_POST['web_url'],$_POST['address']);
				echo '<script>alert("Vendor was Created")</script>';
				header('Location: Login.php');
			}
			else{
				echo '<script>alert("The email you entered is already in use")</script>';
				$error='The email you entered is already in use';
			}
		}
		else{
			$error='something is worng';
		}	
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<title>Registration Form for Vendor</title>
		<link rel="stylesheet" type="text/css" href="../../css/Login.css">
	</head>
	<body>
		<p id="error"><?php echo $error?></p>
		<div class="login-box">
			<h1>Registration for Vendor</h1>
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
					<input type="text" placeholder="phone number" pattern= "[0-9]{10}" name="phone_num" required>
				</div>
				<label for="kind_of_business">Choose Kind of Business:</label>
				  <select class="btn" name="kind_of_business" id="kind_of_business">
					<option value="Balloons">Balloons</option>
					<option value="DJ">DJ</option>
					<option value="photographer">photographer</option>
					<option value="Hall design">Hall design</option>
					<option value="Designing tables">Designing tables</option>
					<option value="seating">seating</option>
					<option value="Catering">Catering</option>
					<option value="Wedding Dresses">Wedding Dresses</option>
					<option value="Makeup">Makeup</option>
					<option value="entertainment show">entertainment show</option>
					<option value="flowers">flowers</option>
					<option value="Alcohol">Alcohol</option>
				  </select>
				<div class="textbox"></div>
				<div class="textbox">
					<i class="fa fa-address-card" aria-hidden="true"></i>
					<input type="text" placeholder="Enter your web url" name="web_url" required>
				</div>
					<label>Region:</label>
					<input type="radio" id="Region1" name="address" value="North">
					<label for="North">North</label>
					<input type="radio" id="Region2" name="address" value="Center">
					<label for="Center">Center</label>
					<input type="radio" id="Region3" name="address" value="South">
					<label for="South">South</label>
			  
				<input class="btn" type="submit" name="submit" value="Registration">
			</form>
			<p> Already have an account? <a href="Login.php">Sign-In</a></p>
		</div>
	</body>
</html>