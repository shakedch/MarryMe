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
        if (!$_POST['email']){
            $error='User is required';
        }
        else if(!$_POST['password']){
            $error='password is required';
        }
        else{
				$tepm = 'Couples';
				$res=$_POST['role'];
				if($res == $tepm){
					$email=$_POST['email'];
					$password=md5($_POST['password']);
					$user=new User();
					$error=$user->find_user_by_name($email,$password);
					if (!$error){
						$session->login($user);
						header('Location: ../../index.php');
					}
				}
				else{
					$email=$_POST['email'];
					$password=md5($_POST['password']);
					$vendor=new Vendor();
					$error=$vendor->find_user_by_name($email,$password);
					if (!$error){
						$session->login($vendor);
						header('Location: ../../index.php');
					}						
				}   
        }
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<title>Login Form</title>
		<link rel="stylesheet" type="text/css" href="../../css/Login.css">
	</head>
	<body>
		<p id="error"><?php echo $error?></p>
		<div class="login-box">
			<h1>Login</h1>
			<form  method="post">
			<div class="textbox">
				<i class="fa fa-user" aria-hidden="true"></i>
				<input type="email" placeholder="Example@gmail.com" name="email">
			</div>
			<div class="textbox">
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input type="password" placeholder="password" name="password">
			</div>
			<label>Role:</label>
			<input type="radio" id="role1" name="role" value="Couples">
			<label for="Couples">Couples</label>
			<input type="radio" id="role2" name="role" value="Vendor">
			<label for="Vendor">Vendor</label>

			<input class="btn" type="submit" name="submit" value="Sign in">
			</form>
			<p> New in Wedding site <a href="./SignUP.php">click here to start</a></p>
		</div>
	</body>
</html>