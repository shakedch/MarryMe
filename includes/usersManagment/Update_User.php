<?php
	//conection to all class
	require_once('../../conection/init.php');
	// chack conenction to DB
	if($database->get_connection()){
		echo "connection is OK <br>";
	}
	else{
		die("conncection failed.");
	}
    global $session; //Makes class variables global for use on each page
	$error='';
	//if user make Update 
	if(isset($_POST['submit'])){
		if($_POST){
			$error=NULL;
			$user= new User(); // Create an empty object
			// A function for update data
			$error=$user->update_data($session->email,$_POST['full_name1'],$_POST['full_name2'],$_POST['date_of_wedding'],$_POST['hour_of_wedding'],$_POST['budget']);
			echo '<script>alert("User was update")</script>';
			header('Location: My_Account.php');
		}
		else{
			// if user make update but there was a error
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
		<title>Update Form for couples</title>
		<link rel="stylesheet" type="text/css" href="../../css/Login.css">
		<link rel="stylesheet" type="text/css" href="../../css/signup.css">

	</head>
	<body>
		<p id="error"><?php echo $error?></p>
		<div class="login-box">
			<h1>Update for <?php echo $session->email?></h1>
			<!-- form for update  -->
			<form method="post">
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
				<input class="btn" type="submit" name="submit" value="Update">
			</form>
		</div>
	</body>
</html>