<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->


    <link href="../../css/general.css?v=1.0" rel="stylesheet" type="text/css" />
    <link href="../../css/offers.css?v=1.0" rel="stylesheet" type="text/css" />


    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/90569433a0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <!-- tab view -->
    <link rel="shortcut icon" href="../../assets/img/tab_logo.png" type="image/png">
    <title> Marry Me</title>
    <!-- general fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&family=Josefin+Sans:wght@500&family=Niconne&display=swap" rel="stylesheet">

</head>

<body>

    <?php require_once 'offersProcess.php'; ?>

    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?> ">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>

    <div class="header">
        <div class="img-holder" data-image="../../assets/img/parallax_offers.png">
        </div>
        <div>
            <h1 class="head-text">Offers</h1>
        </div>
    </div>

    <div class="container">
        <?php
        $mysqli = new mysqli("localhost:3308", "root", "", "marryme") or die(mysqli_error(($mysqli)));
        $result = $mysqli->query("SELECT * FROM offers WHERE vendor_id='2' ") or die($mysqli->error);
        /*כאן נצטרך לעשות תנאי נוסף של להציג רק מי שהסשן של המשתמש הוא הספק המחובר*/

        ?>

        <div class="row justify-content-center">


            <?php
            while ($row = $result->fetch_assoc()) : ?>

                <div class="grid-container mb-3 mt-3">

                    <div class="item1">
                        <?php
                        echo
                        "<td class='photoUpload'><img class='centerPic' src='../../assets/img/offersUploads/" . (($row["img"] == '') || ($row["img"] == '.') ? 'no-image-available.png' : $row["img"]) . "' align='center' height='65' /></td>";
                        ?>

                    </div>

                    <div class="item2">
                        <h2><?php echo $row['name'] ?></h2>
                    </div>
                    <div class="item3"><?php echo $row['price'] ?> &#8362; </div>
                    <div class="item4">
                        <a href="offersProcess.php?delete=<?php echo $row['offer_id']; ?>" class="btn btn-danger">Delete <i class="fas fa-trash"></i></a>
                    </div>
                    <div class="item5">
                        <a href="offers.php?edit=<?php echo $row['offer_id']; ?>" class="btn btn-info">Edit <i class="fas fa-edit"></i></a>
                    </div>
                    <div class="item6"><?php echo $row['description'] ?></div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>


    <dialog id="myDialog">
        <button onclick="parent.location='offers.php'">&#10008;</button>
        <h2>Add New Offer</h2>
        <div class="row pr-5 pl-5 ">
            <form name="offers_form" action="offersProcess.php" id="offers_form" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="offer_id" value="<?php echo $offer_id; ?>">

                <div class="form-group ">
                    <lable>offer name</lable>
                    <input type="text" id="name" name="name" class="form-control" maxlength="55" value="<?php echo $name; ?>" placeholder="Enter the offer name">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>

                <div class="form-group">
                    <lable>valid date</lable>
                    <input type="datetime-local" id="valid_date" name="valid_date" class="form-control" value="<?php echo $valid_date; ?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>

                <div class="form-group">
                    <lable>description</lable>
                    <input type="text" id="description" name="description" class="form-control" maxlength="255" placeholder="Enter the description of the offer" value="<?php echo $description; ?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>

                <div class="form-group ">
                    <lable>price</lable>
                    <input type="text" id="price" name="price" class="form-control" maxlength="255" min="1" placeholder="XXX &#8362;" value="<?php echo $price; ?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>

                <div class="form-group">
                    <lable>relevant image</lable>
                    <input type="file" id="img" name="img" class="form-control" accept="image/png, image/jpeg" placeholder="Enter a relevant image for the offer" multiple value="<?php echo $img; ?>">

                </div>

                <div class="form-group">
                    <?php
                    if ($update == true) : ?>

                        <button type="submit" name="update" class="btn btn-info">Update</button>
                    <?php
                    else : ?>
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <?php
                    endif; ?>
                </div>

            </form>

        </div>
        <button onclick="parent.location='offers.php'" class="btn btn-secondary">Close</button>

    </dialog>

    <button class="add-offer" onclick="window.dialog.showModal();">+</button>
    <script>
        if ((window.location.href).includes("edit")) document.getElementById("myDialog").showModal();
    </script>




    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://rawgithub.com/pederan/Parallax-ImageScroll/master/jquery.imageScroll.min.js" type="text/javascript"></script>
    <script src="../general.js"></script>
    <script src="offers.js"></script>



</body>

</html>