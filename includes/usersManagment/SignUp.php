<?php
//conection to all class
require_once('../../conection/init.php');
// chack conenction to DB

global $session; //Makes class variables global for use on each page
$error = '';
?>


<!DOCTYPE html>
<html>

<head>
    <!-- connection css and bootstrap and metadata -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700&amp;display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&family=Josefin+Sans:wght@500&family=Niconne&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../../css/register.css">
    <link rel="stylesheet" href="../../css/general.css">
    <link rel="stylesheet" type="text/css" href="../../css/login.css">
    <link rel="shortcut icon" href="../../assets/img/tab_logo.png" type="image/png">
    <title>Registration</title>
</head>

<body>
    <p id="error"><?php echo $error ?></p>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="../../assets/img/REvendor.jpg" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block overlyCarouselLight">
                                        <br>
                                        <!-- for new vendor -->
                                        <h4>Vendors</h4>
                                        <p>If you are a vendor and to join us.</p>
                                        <a class='carouselButton' href="./signUpVendor.php"><button>Click here to
                                                register as
                                                vendor</button></a>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="../../assets/img/REcouples.jpg" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block overlyCarousel">
                                        <!-- for new user -->
                                        <h4>Couples getting married?</h4>
                                        <p>Join us and manage your tasks!.</p>
                                        <a class='carouselButton' href="./signUpUser.php"><button>Click Here to register
                                                as
                                                couples</button></a>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="../../assets/img/RElogin.jpg" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block overlyCarousel">
                                        <!-- for user that have account -->
                                        <h4>Already have an account?</h4>
                                        <p>You came here by mistake?</p>
                                        <a class='carouselButton' href="./login.php"><button>Click Here to
                                                login</button></a>
                                    </div>
                                </div>

                            </div>
                            <!-- Carousel navigation -->
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
</body>

</html>