<?php
//conection to all class
require_once('../../conection/init.php');
global $session; //Makes class variables global for use on each page
	$role = $_SESSION['role'];
	$temp = 'couple';
	if($role == $temp)
	{
		// for navbar for user
		$one_n = "My Task";
		$sec_n = "Market";	
		$thr_n = "My Offer";
		$inout = "Log Out";
		$SeeCre = "See Your Account";
		$where0 = "../tasksProcess/tasks.php";
		$where1 = "LogOut.php";
		$where2 = "My_Account.php";
		$where3 = "../marketAndOffers/market.php";
		$where4 = "../my_OFFER/offer_wish.php";
	}
	else
	{
		// for navbar for vendor
		$one_n = "Offers";
		$sec_n = "";
		$thr_n = "";
		$inout = "Log Out";
		$SeeCre = "See Your Account";
		$where0 = "../marketAndOffers/offers.php";
		$where1 = "LogOut.php";
		$where2 = "My_Account.php";			
		$where3 = "#";	
		$where4 = "#";
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
		<link rel="stylesheet" type="text/css" href="../../css/HeadFoot.css">
    <link rel="stylesheet" type="text/css" href="../../css/hpStyle.css"> 
    <link rel="stylesheet" type="text/css" href="../../css/general.css">
	<title>Wedding</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<!-- move this lines to a css file -->
    <style>
         .inf-content{
    border:1px solid #DDDDDD;
    -webkit-border-radius:10px;
    -moz-border-radius:10px;
    border-radius:10px;
    box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);
}			                                                      
    </style>

</head>

<body>
    <div id="wrapper">
        <div>
	<!-- navbar by variables -->
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark p-md-3">
      <div class="container">
        <a class="navbar-brand" href="#">Wedding</a>
		<ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link text-black" href="../../index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-black" href="<?php echo $where0 ?>"><?php echo $one_n ?></a>
            </li>
			<li class="nav-item">
              <a class="nav-link text-black" href="<?php echo $where3 ?>"><?php echo $sec_n ?></a>
            </li>
          </ul>
        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="mx-auto"></div>
		        <span class="navbar-text text-black"><?php echo $role ?></span>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link text-primary" href="<?php echo $where1?>"><?php echo $inout?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-primary" href="<?php echo $where2?>"><?php echo $SeeCre?></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
	
			<?php 
				if($session->signed_in){
					if($role =='couple'){
						$error='';
						$user=new User(); // Create an empty object
						$error=$user->find_user_by_email($session->email);	// Inserting data into an object		
					
				
					?>			
					
					<!-- table with user data -->
					<div class="container bootstrap snippets bootdey">
    <div class="panel-body inf-content">
        <div class="row">
            <div class="col-md-4">
              
              <!-- <img alt="" style="width:600px;" title="" class="img-circle img-thumbnail isTooltip" src="https://bootdey.com/img/Content/avatar/avatar7.png" data-original-title="Usuario">  -->
              <img alt="" style="width:250px;" title="" class="img-circle img-thumbnail isTooltip" src="../../assets/img/one.jpg" data-original-title="Usuario"> 

              
            </div>
            <div class="col-md-6">
                <strong>Information</strong><br>
                <div class="table-responsive">
                <table class="table table-user-information">
                    <tbody>
                        <tr>    
                            <td>
                                <strong>
                                    <span class="glyphicon glyphicon-user  text-primary"></span>    
                                    Full name 1                                               
                                </strong>
                            </td>
                            <td class="text-primary">
                                <?php echo $user->full_name1; ?>   
                            </td>
                        </tr>
                        <tr>        
                            <td>
                                <strong>
                                    <span class="glyphicon glyphicon-user text-primary"></span>  
                                    Full name 2                                               
                                </strong>
                            </td>
                            <td class="text-primary">
                               <?php echo $user->full_name2; ?>
                            </td>
                        </tr>
    
                        <tr>        
                            <td>
                                <strong>
                                    <span class="glyphicon glyphicon-calendar text-primary"></span> 
                                    Date of wedding                                               
                                </strong>
                            </td>
                            <td class="text-primary">
                                <?php echo $user->date_of_wedding; ?>
                            </td>
                        </tr>
    
    
                        <tr>        
                            <td>
                                <strong>
                                    <span class="glyphicon glyphicon-time text-primary"></span> 
                                   Hour of wedding                                               
                                </strong>
                            </td>
                            <td class="text-primary">
                                <?php echo $user->hour_of_wedding; ?>
                            </td>
                        </tr>
                        <tr>        
                            <td>
                                <strong>
                                    <span class="glyphicon glyphicon-envelope text-primary"></span> 
                                    Email                                                
                                </strong>
                            </td>
                            <td class="text-primary">
                              <?php echo $user->email; ?>
                            </td>
                        </tr>
                        <tr>        
                            <td>
                                <strong>
                                    <span class="glyphicon glyphicon-exclamation-sign text-primary"></span>
                                    Budget                                                
                                </strong>
                            </td>
                            <td class="text-primary">
                              <?php echo $user->budget; ?>
                            </td>
                        </tr>
                                                        
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    </div>  
					<!-- button to change data -->
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
						$user=new Vendor(); // Create an empty object
						$error=$user->find_user_by_email($session->email);	// Inserting data into an object	
				?>
				<!-- table with user data -->
				<div class="container bootstrap snippets bootdey">
        <div class="panel-body inf-content">
            <div class="row">
                <div class="col-md-4">
                    <!-- <img alt="" style="width:600px;" title="" class="img-circle img-thumbnail isTooltip" src="https://bootdey.com/img/Content/avatar/avatar7.png" data-original-title="Usuario">  -->
                    <img alt="" style="width:250px;" title="" class="img-circle img-thumbnail isTooltip" src="../../assets/img/one.jpg" data-original-title="Usuario"> 

                </div>
                <div class="col-md-6">
                    <strong>Information</strong><br>
                    <div class="table-responsive">
                    <table class="table table-user-information">
                        <tbody>
                            <tr>    
                                <td>
                                    <strong>
                                        <span class="glyphicon glyphicon-user  text-primary"></span>    
                                        Company name                                                
                                    </strong>
                                </td>
                                <td class="text-primary">
                                    <?php echo $user->company_name; ?> 
                                </td>
                            </tr>
                            <tr>        
                                <td>
                                    <strong>
                                        <span class="glyphicon glyphicon-phone text-primary"></span>  
                                        Phone number                                                
                                    </strong>
                                </td>
                                <td class="text-primary">
                                    <?php echo $user->phone_num; ?>
                                </td>
                            </tr>
        
                            <tr>        
                                <td>
                                    <strong>
                                        <span class="glyphicon glyphicon-bookmark text-primary"></span> 
                                        Kind of business                                                
                                    </strong>
                                </td>
                                <td class="text-primary">
                                    <?php echo $user->kind_of_business; ?>
                                </td>
                            </tr>
        
        
                            <tr>        
                                <td>
                                    <strong>
                                        <span class="glyphicon glyphicon-cloud text-primary"></span> 
                                        Web Url                                                
                                    </strong>
                                </td>
                                <td class="text-primary">
                                    <?php echo $user->web_url; ?>
                                </td>
                            </tr>
                            <tr>        
                                <td>
                                    <strong>
                                        <span class="glyphicon glyphicon-envelope text-primary"></span> 
                                        Email                                                
                                    </strong>
                                </td>
                                <td class="text-primary">
                                    <?php echo $user->email; ?>
                                </td>
                            </tr>
                            <tr>        
                                <td>
                                    <strong>
                                        <span class="glyphicon glyphicon-globe text-primary"></span>
                                        Adress                                                
                                    </strong>
                                </td>
                                <td class="text-primary">
                                    <?php echo $user->address; ?>
                                </td>
                            </tr>                                   
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        </div> 
					<!-- button to change data -->
						<button type="button" class ="btn btn-outline-danger btn-md"><a href = "Update_Vendor.php">Update Data </a></button>
					</tr>
					</tbody>
					</table>
				<?php
				}
				}	
				?>
			</div>


				
</body>
</html>
