<?php
require_once('../../conection/init.php');
global $session;
if($session->signed_in){

	$role = $_SESSION['role'];
	$inout = "Log Out";
	$SeeCre = "See Your Account";
	$where1 = "LogOut.php";
	$where2 = "My_Account.php";
}
else{	
	$role = "Hello Guest";
	$inout = "Sign in";
	$SeeCre = "Create New Account";
	$where1 = "Login.php";
	$where2 = "SignUp.php";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>DOG'S WORLD</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/HeadFoot.css">		
	<script src = "https://code.jquery.com/jquery-3.5.0.js"></script>	
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>	

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
                        <li class="nav-item "><a class="nav-link active" href="../../index.php" "javascript:void(0)">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="../../offer.php" "javascript:void(0)">offer</a></li>
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
						$error='';
						$user=new User();
						$error=$user->find_user_by_email($session->email);			
					
				
					?>			
					
					
					<table class="table table-striped">
					<thead>
					<tr>
						<th scope="col">user_id</th>
						<th scope="col">Email</th>
						<th scope="col">Full_Name1</th>
						<th scope="col">Full_Name2</th>
						<th scope="col">Date_OF_Wedding</th>
						<th scope="col">Hour_OF_Wedding</th>
						<th scope="col">Budget</th>

					</tr>
					</thead>
					<tbody>
					<tr>
					  <td><?php echo $user->user_id; ?></td>
					  <td><?php echo $user->email; ?></td>
					  <td><?php echo $user->full_name1; ?></td>
					  <td><?php echo $user->full_name2; ?></td>
					  <td><?php echo $user->date_of_wedding; ?></td>
					  <td><?php echo $user->hour_of_wedding; ?></td>
					  <td><?php echo $user->budget; ?></td>
					</tr>
					<tr>
						<button type="button" class ="btn btn-outline-danger btn-md"><a href = "Update_User.php">Update Data </a></button>
					</tr>
					</tbody>
					</table>          
					<div id="clear"></div>
				<?php
				}
					else{
						$error='';
						$user=new Vendor();
						$error=$user->find_user_by_email($session->email);		
				?>
					<table class="table table-striped">
					<thead>
					<tr>
						<th scope="col">vendor_id</th>
						<th scope="col">Email</th>
						<th scope="col">Company_Name</th>
						<th scope="col">Phone_Num</th>
						<th scope="col">Kind_of_Business</th>
						<th scope="col">Web_Url</th>
						<th scope="col">Address</th>

					</tr>
					</thead>
					<tbody>
					<tr>
					  <td><?php echo $user->vendor_id; ?></td>
					  <td><?php echo $user->email; ?></td>
					  <td><?php echo $user->company_name; ?></td>
					  <td><?php echo $user->phone_num; ?></td>
					  <td><?php echo $user->kind_of_business; ?></td>
					  <td><?php echo $user->web_url; ?></td>
					  <td><?php echo $user->address; ?></td>
					</tr>
					<tr>
						<button type="button" class ="btn btn-outline-danger btn-md"><a href = "Update_Vendor.php">Update Data </a></button>
					</tr>
					</tbody>
					</table>
				<?php
				}
				}	
				?>
				</div>
			</div>


				
</body>
</html>
