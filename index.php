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
    
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstra4.5.2/css/bootstrap.min.css"> -->
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript">
    </script>
    <script src="https://kit.fontawesome.com/90569433a0.js" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.css"
        integrity="sha512-ENnX3mn8eIEmPp8XJ30lCs82Ux76IHv3ZeK9Z4TGzmBDEyYmYodgeqFIw7207m3f1Lhl9t1nMzPxHF6p+YD5Pw=="
        crossorigin="anonymous" />
    <!-- general fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700&amp;display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&family=Josefin+Sans:wght@500&family=Niconne&display=swap"
        rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="./css/HeadFoot.css">
    <link rel="stylesheet" type="text/css" href="./css/hpStyle.css"> 
    <link rel="stylesheet" type="text/css" href="./css/general.css">
	<title>Wedding</title>

</head>
<body>
    <div id="wrapper">
        <div>
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
			 <div id='wrapper'>
        <!-- TODO: Video here -->
        <header>
            <div class="overlay"></div>
            <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
                <source src="./assets/videos/flowers.mp4" type="video/mp4">
                <source src="./assets/videos/flowers.webm" type="video/mp4">
                <!-- <source src="https://storage.googleapis.com/coverr-main/mp4/Mt_Baker.mp4" type="video/mp4"> -->
            </video>
            <div class="container2 h-100">
                <div class="d-flex h-100 text-center align-items-center">
                    <div class="w-100 text-white">
                        <h1 class="display-3"><img style="width:25rem;height:25rem;" src="./assets/img/logo_transparent.png" alt="Logo"></h1>
                        <!-- <h1 class="display-3">Marry Me</h1> -->
                        <!-- TODO: Change this line ! -->
                        <p class="lead mb-0">Manage you wedding with us!</p>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <!-- TODO: Out story div here (with lot of text) here -->
    <div class='divWrapper'>
        <div class='aboutUs'>
            <h2>About us</h2>
            <p id="ourStoryText"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi lacus turpis, commodo
                vitae elit eu, finibus convallis elit. Vivamus vulputate lobortis rutrum. Sed viverra, elit nec luctus
                convallis, nunc massa bibendum nulla, sit amet dictum justo erat ut metus. Integer porttitor sagittis
                justo, eget pulvinar orci dictum eget. Integer ut nulla ut dui aliquam aliquet nec at erat. Nullam vel
                eros nibh. Donec tincidunt ligula sem, dapibus iaculis felis lacinia eu. Sed in ex eu nunc egestas
                consectetur. Pellentesque at ligula ut est rutrum efficitur. Pellentesque maximus diam sed massa
                pellentesque, in dignissim eros elementum. Sed luctus turpis nunc, quis vulputate arcu dapibus nec. Sed
                non justo lacus. Curabitur posuere laoreet magna, id ullamcorper lectus imperdiet sed. Nam magna nunc,
                volutpat sit amet ipsum sit amet, sollicitudin pretium purus. Nam in iaculis nunc, id pretium ligula.
                Sed suscipit pellentesque mauris, ac convallis lacus mollis sed. In posuere mi quis tellus dictum, ac
                facilisis ex mattis. Donec in tincidunt purus, sed consequat dolor. Ut eu tellus quis orci efficitur
                consectetur. </p>
        </div>
    </div>
    <!-- TODO: Some image in full width here -->
    <div class="img-holder" data-image="./assets/img/hp_img_one.jpg">
    </div>
    <!-- TODO: 3 element :[ offer to regular user , I DO button, offer to vendor user] here -->
    <div class='divWrapper' id='offers'>
        <div class='textOffers'>
            <div class='textOfferBox'>
                <h3>Offer to regular user</h3>
                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi lacus turpis, commodo vitae elit eu,
                    finibus convallis elit. Vivamus vulputate lobortis rutrum. Sed viverra, elit nec luctus convallis,
                    nunc massa bibendum nulla, sit amet dictum justo erat ut metus. Integer porttitor sagittis justo,
                    eget pulvinar orci dictum eget.</p>
            </div>
            <div class='textOfferBox'>
                <h3>Offer to vendor user</h3>
                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi lacus turpis, commodo vitae elit eu,
                    finibus convallis elit. Vivamus vulputate lobortis rutrum. Sed viverra, elit nec luctus convallis,
                    nunc massa bibendum nulla, sit amet dictum justo erat ut metus. Integer porttitor sagittis justo,
                    eget pulvinar orci dictum eget.</p>
            </div>
        </div>
        <div class='joinUs'>
            <h3>Will you join us?</h3>
            <!-- <div class='offerBox'> --><a class='iDoLink' href="http://www.google.com" target="_self"
                rel="noopener noreferrer"><button type="button">I Do!</button></a><!-- </div> -->
        </div>
    </div>
    <!-- TODO: Some image in full width here -->
    <div class="img-holder" data-image="./assets/img/hp_img_two.jpg">
    </div>
    <!-- Necessary scripts-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://rawgithub.com/pederan/Parallax-ImageScroll/master/jquery.imageScroll.min.js"
        type="text/javascript"></script>
    <script src="./includes/general.js"></script>
		<?php
		}
		?>
		</div>
	</div>


</body>
</html>
