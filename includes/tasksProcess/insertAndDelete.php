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

// need to add session 



if (isset($_POST["save"])) {
    $name = $_POST["name"];
    $startDate = $_POST["start_date"];
    $dueDate = $_POST["due_date"];
    $cost = $_POST["cost"] == '' ? 0 : $_POST["cost"];
    $description = $_POST["description"];
    $status = $_POST["status"];

    $mysqli->query("INSERT INTO `tasks`(`user_id`, `name`, `start_date`, `due_date`, `cost`, `description`, `status`) VALUES (1,'$name','$startDate','$dueDate','$cost','$description','$status')") or
        die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location:tasks.php");
}



if (isset($_GET['deleteTask'])) {
    $task_id = $_GET['deleteTask'];
    $mysqli->query("DELETE FROM tasks WHERE`tasks`.`task_id`=$task_id") or
        die($mysqli->error);


    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";



    header("location:tasks.php");
}