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
		    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

		<link rel="stylesheet" type="text/css" href="../../css/Login.css">
	</head>
	<body>
		<p id="error"><?php echo $error?></p>
	    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <img src="../../assets/img/one.jpg" alt="login" class="login-card-img">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <p class="login-card-description">Sign into your account</p>
                            <form method="post">
                                <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Email address">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="***********">
                                </div>
                                <div class="form-group mb-4">
                                    <label>Role:</label>
                                    <input type="radio" id="role1" name="role" value="Couples">
                                    <label for="Couples">Couples</label>
                                    <input type="radio" id="role2" name="role" value="Vendor">
                                    <label for="Vendor">Vendor</label>
                                </div>
                                <input name="submit" id="login" class="btn btn-block login-btn mb-4" type="submit"
                                    value="Sign in">
                            </form>
                            <p class="login-card-footer-text">Don't have an account? <a href="./SignUP.php"
                                    class="text-reset">Register here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

	</body>
</html>