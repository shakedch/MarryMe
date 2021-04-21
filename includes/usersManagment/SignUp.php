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
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<title>Registration</title>
		<link rel="stylesheet" type="text/css" href="../../css/Login.css">
	</head>
	<body>
		<p id="error"><?php echo $error?></p>
		<div class="login-box">
			<h1>Registration</h1>
			<p> couples getting married <a href="SignUP_User.php">Click Here</a></p>
			<p> For service providers <a href="SignUP_Vendor.php">Click Here</a></p>
			<p> Already have an account? <a href="Login.php">Sign-In</a></p>			
		</div>
	</body>
</html>