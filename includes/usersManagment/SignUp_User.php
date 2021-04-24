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
			$user= new User();
			$vendor = new Vendor();
			$error1 = $user->find_email($_POST['email']);
			$error2 = $vendor->find_email($_POST['email']);
			if($error1 == null && $error2 == null ){
				$error=user::add_user($_POST['email'],$_POST['password'],$_POST['full_name1'],$_POST['full_name2'],$_POST['date_of_wedding'],$_POST['hour_of_wedding'],$_POST['budget']);
				echo '<script>alert("User was Created")</script>';
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
		<title>Registration Form for couples</title>
		<link rel="stylesheet" type="text/css" href="../../css/Login.css">
	</head>
	<body>
		<p id="error"><?php echo $error?></p>
		<div class="login-box">
			<h1>Registration for couples</h1>
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
	</body>
</html>