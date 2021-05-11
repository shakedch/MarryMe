<?php
	//conection to all class
	require_once('../../conection/init.php');
    global $session; //Makes class variables global for use on each page
	$error='';
	//if user make Registration 
	if(isset($_POST['submit'])){
		if($_POST){
			$error1=NULL;
			$error2=NULL;
			$user= new User(); // Create an empty object
			$vendor = new Vendor(); // Create an empty object
			$error1 = $user->find_email($_POST['email']); //A function that aims to check that there is no registered email like the email that the new customer entered
			$error2 = $vendor->find_email($_POST['email']); //A function that aims to check that there is no registered email like the email that the new customer entered
			// added code 09.05.2021
			$date_of_wedding = $_POST['date_of_wedding'];
			$changeDate = date("Y-m-d", strtotime($date_of_wedding));
  	        $today = date("Y-m-d");
			  if($changeDate < $today){
				header("location: ../usersManagment/signUp_user.php?dateError");
                exit();
			  }
			// end of added code
			if($error1 == null && $error2 == null ){ // If there is no email already registered
				//Function for adding a user
				$error=user::add_user($_POST['email'],$_POST['password'],$_POST['full_name1'],$_POST['full_name2'],$_POST['date_of_wedding'],$_POST['hour_of_wedding'],$_POST['budget']);
				echo '<script>alert("User was Created")</script>';
				header('Location: Login.php');
			}
			else{
				//If the function found a registered email already
				echo '<script>alert("The email you entered is already in use")</script>';
				$error='The email you entered is already in use';
			}
		}
		else{
			// if user make Registration but there was a error
			$error='something is worng';
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
		<title>Registration Form for couples</title>
		<!-- <link rel="stylesheet" type="text/css" href="../../css/Login.css"> -->
		<link rel="stylesheet" type="text/css" href="../../css/signup.css">
	</head>
	<body>
		<p id="error"><?php echo $error?></p>
		<div class="login-box">
			<h1>Registration - Couples</h1>
			<!-- form for Registration  -->
			<form method="post">
				<div class="textbox">
					<i class="fa fa-envelope" aria-hidden="true"></i>
					<input type="email" placeholder="Example@gmail.com" name="email" required>
				</div>
				<div class="textbox">
					<i class="fa fa-lock" aria-hidden="true"></i>
					<input type="password" placeholder="password" name="password" required>
				</div>
				<div class="textbox">
					<i class="fa fa-address-card" aria-hidden="true"></i>
					<input type="text" placeholder="Enter first full name" name="full_name1" required>
				</div>
				<div class="textbox">
					<i class="fa fa-address-card" aria-hidden="true"></i>
					<input type="text" placeholder="Enter second full name" name="full_name2" required>
				</div>
				<div class="textbox">
					<i class="fa fa-calendar" aria-hidden="true"></i>
					<input type="date" placeholder="Enter Wedding Date" name="date_of_wedding" required>
				</div>
				<div class="textbox">
					<i class="fa fa-calendar" aria-hidden="true"></i>
					<input type="time" placeholder="Enter hour of wedding" name="hour_of_wedding" required>
				</div>
				<div class="textbox">
					<i class="fa fa-question-circle" aria-hidden="true"></i>
					<input type="text" placeholder="What is your budget?" name="budget" required>
				</div>		
				<input class="btn" type="submit" name="submit" value="Registration">
			</form>
			<p> Already have an account? <a href="Login.php">Sign-In</a></p>
		</div>
		<!-- added code 9/5/2021 -->
		<?php
		if(isset($_GET["dateError"])){
			echo "<script> alert('impossible date');</script>";
		}
		?>
		<!-- end of code -->
	</body>
</html>