<?php
require_once('conection/init.php');
global $session;
if($session->signed_in){

	$role = $_SESSION['role'];
	$inout = "Log Out";
	$SeeCre = "See Your Account";
	$where1 = "includes/usersManagment/LogOut.php";
	$where2 = "includes/usersManagment/My_Account.php";
}
else{	
	$role = "Hello Guest";
	$inout = "Sign in";
	$SeeCre = "Create New Account";
	$where1 = "includes/usersManagment/Login.php";
	$where2 = "includes/usersManagment/SignUp.php";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Wedding</title>
    <!-- Favicon-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/HeadFoot.css">
</head>
<body>
    <div id="wrapper">
        <div id="internalWrapper">
            <nav class="navbar navbar-expand-md navbar-light ">
                <a style="font-family: fantasy; font-size: 35px; color: #8A2C47" class="navbar-brand" href="#"><i>Wedding</i></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav text-uppercase">
                        <li class="nav-item "><a class="nav-link active" href="index.php" "javascript:void(0)">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="offer.php" "javascript:void(0)">offer</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">###</a></li>
                    </ul>
					<ul class="navbar-nav text-uppercase ml-auto">					
						<li class="nav-item nav-link waves-effect"><?php echo $role?></a></li>
						<li class="nav-item"><a href="<?php echo $where1?>" style= "padding-left: 30px" class="nav-link waves-effect"><?php echo $inout?></a></li>						
						<li class="nav-item pl-auto"><a href="<?php echo $where2?>"  type="button"class="btn btn-outline-danger btn-md btn-rounded btn-navbar waves-effect waves-light"><?php echo $SeeCre?></a></li>
					</ul>
                </div>
            </nav>
            <hr>
		<?php 
		if($session->signed_in){
			if($role =='couple'){
						
			?>			
			<h1> you are user </h1>
			<p> the session ID is: <?php echo $session->id?> </p>
			<p> the session email is: <?php echo $session->email?> </p>
			<p> the session role is: <?php echo $session->role?> </p>
		<?php
		}
			else{
				
		?>
			<h1> you are vendor </h1>
			<p> the session ID is: <?php echo $session->id?> </p>
			<p> the session email is: <?php echo $session->email?> </p>
			<p> the session role is: <?php echo $session->role?> </p>
		<?php
		}
		}
		else{
		?>
		<h1> you need to sign in </h1>
		<?php
		}
		?>
		</div>
	</div>


</body>
</html>
