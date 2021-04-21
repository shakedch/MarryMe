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
			$error=NULL;
			$vendor= new Vendor();
			$error=$vendor->update_data($session->email,$_POST['company_name'],$_POST['phone_num'],$_POST['kind_of_business'],$_POST['web_url'],$_POST['address']);
			echo '<script>alert("vendor was update")</script>';
			header('Location: My_Account.php');
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
		<title>Update Form for couples</title>
		<link rel="stylesheet" type="text/css" href="../../css/Login.css">
	</head>
	<body>
		<p id="error"><?php echo $error?></p>
		<div class="login-box">
			<h1>Update for <?php echo $session->email?></h1>
			<form method="post">
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
			  
				<input class="btn" type="submit" name="submit" value="update">
			</form>
		</div>
	</body>
</html>