<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "marryme") or die(mysqli_error(($mysqli)));

// $id = 0;
$update = false;
$name = "";
$startDate = "";
$dueDate = "";
$cost = "";
$description = "";
$status = "";
$attachedFile = "";

if (isset($_POST["save"])) {
    $name = $_POST["name"];
    $startDate = $_POST["startDate"];
    $dueDate = $_POST["dueDate"];
    $cost = $_POST["cost"];
    $description = $_POST["description"];
    $status = $_POST["status"];
    $attachedFile = $_POST["attachedFile"];

    // Add Query => insert into table (the TABLE name is `data`)
    // Insert :name,location values

    $mysqli->query("INSERT INTO tasks (t_name,t_due_date,
    tr_id,
    t_start_date,
    t_cost,
    t_description,
    t_status,
    t_attached_files
    ) VALUES('$name','$dueDate','someId','$startDate','$cost','$description','$status','$attachedFile')") or
        die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location:myTasks.php");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id =$id") or
        die($mysqli->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location:tasks.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);
    if (is_iterable($result)) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE data SET name='$name',location='$location' WHERE id=$id") or die($mysqli->error);
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";
    header("location:tasks.php");
}
