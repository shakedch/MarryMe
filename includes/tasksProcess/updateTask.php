<?php
//set the variable name
$task_id = $_POST['task_id'];
$name = $_POST['viewName'];
$start_date = $_POST['view_start_date'];
$due_date = $_POST['due_date'];
$cost = $_POST['cost'];
$description = $_POST['description'];
$status = $_POST['status'];

if (isset($task_id)) {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "marryme";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE `tasks` SET `name` = '$name',`start_date`='$start_date',`due_date`='$due_date',`cost`='$cost',`description`='$description',`status`='$status'
     WHERE `tasks`.`task_id` = '$task_id';";

    if ($conn->query($sql) === TRUE) {
        echo 1;
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}