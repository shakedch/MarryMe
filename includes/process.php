<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "marryme") or die(mysqli_error(($mysqli)));

$id = " ";
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
    $startDate = $_POST["start_date"];
    $dueDate = $_POST["due_date"];
    $cost = $_POST["cost"];
    $description = $_POST["description"];
    $status = $_POST["status"];
    $attachedFile = $_POST["attached_file"];

    // Add Query => insert into table (the TABLE name is `data`)
    // Insert :name,location values

    $mysqli->query("INSERT INTO `tasks`(`user_id`, `name`, `start_date`, `due_date`, `cost`, `description`, `status`, `attached_file`) VALUES (1,'$name','$startDate','$dueDate','$cost','$description','$status','$attachedFile')") or
        die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location:myTasks.php");
}

if (isset($_GET['delete'])) {
    $name = $_GET['name'];
    $dueDate = $_GET['dueDate'];
    $mysqli->query("DELETE FROM tasks WHERE`tasks`.`t_name`=$name AND `tasks`.`t_due_date`=$dueDate") or
        die($mysqli->error);


    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location:myTasks.php");
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