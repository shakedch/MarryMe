<?php

function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}


session_start();
$mysqli = new mysqli("localhost", "root", "", "marryme") or die(mysqli_error(($mysqli)));

$task_id = " ";
$update = false;
$name = "";
$startDate = date('Y-m-d\TH:i');
$minDueDate = date('Y-m-d\TH:i');
$dueDate = '';
$cost = "";
$description = "";
$status = '';
$attachedFile = "";

// need to add session 

if (isset($_POST["save"])) {
    $name = $_POST["name"];
    $startDate = $_POST["start_date"];
    $dueDate = $_POST["due_date"];
    $cost = $_POST["cost"] == '' ? '0' : $_POST["cost"];
    $description = $_POST["description"];
    $status = $_POST["status"];
    $attachedFile = $_POST["attached_file"];
    debug_to_console($attachedFile);




    $mysqli->query("INSERT INTO `tasks`(`user_id`, `name`, `start_date`, `due_date`, `cost`, `description`, `status`, `attached_file`) VALUES (1,'$name','$startDate','$dueDate','$cost','$description','$status','$attachedFile')") or
        die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location:myTasks.php");
}

if (isset($_GET['delete'])) {
    $task_id = $_GET['delete'];
    $mysqli->query("DELETE FROM tasks WHERE`tasks`.`task_id`=$task_id") or
        die($mysqli->error);


    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location:myTasks.php");
}

if (isset($_GET['edit'])) {
    $task_id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM tasks WHERE task_id=$task_id") or die($mysqli->error);
    if (is_iterable($result)) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $startDate = str_replace(' ', 'T', $row['start_date']);
        $dueDate = str_replace(' ', 'T', $row['due_date']);
        $cost = $row['cost'];
        $description = $row['description'];
        $status = $row['status'];
        $attachedFile = $row['attached_file'];
    }
}

if (isset($_POST['update'])) {
    $task_id = $_POST['task_id'];
    $name = $_POST['name'];
    $startDate = $_POST['start_date'];
    $dueDate = $_POST['due_date'];
    $cost = $_POST['cost'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $attachedFile = $_POST['attached_file'];


    $mysqli->query("UPDATE tasks SET name='$name',start_date='$startDate',due_date='$dueDate',cost='$cost',description='$description',status='$status',attached_file='$attachedFile' WHERE task_id=$task_id") or die($mysqli->error);
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";
    header("location:myTasks.php");
}
