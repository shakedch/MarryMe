<?php

require_once('../../conection/init.php');
global $session;
global $database;



$task_id = " ";
$update = false;
$name = "";
$nameBank = "";
$startDate = date('Y-m-d\TH:i');
$minDueDate = date('Y-m-d\TH:i');
$dueDate = '';
$cost = "";
$description = "";
$status = '';




if (isset($_POST["save"])) {
    $name = $_POST["name"];
    $nameBank = $_POST["nameBank"];
    $startDate = $_POST["start_date"];
    $dueDate = $_POST["due_date"];
    $cost = $_POST["cost"] == '' ? 0 : $_POST["cost"];
    $description = $_POST["description"];
    $status = $_POST["status"];


    $fullStartDate = $startDate . ':00' . 'Z';
    $fullDueDate = $dueDate . ':00' . 'Z';

    $_SESSION['start_date'] = $fullStartDate;

    $_SESSION['due_date'] = $fullDueDate;
    $_SESSION['description'] = $description;

    if ($name === '') {
        $_SESSION['name'] = $nameBank;
        $database->query("INSERT INTO `tasks`(`user_id`, `name`, `start_date`, `due_date`, `cost`, `description`, `status`) VALUES ('" . $session->id . "','$nameBank','$startDate','$dueDate','$cost','$description','$status')") or
            die($database->query);
    } elseif ($nameBank <= 0) {
        $_SESSION['name'] = $name;
        $database->query("INSERT INTO `tasks`(`user_id`, `name`, `start_date`, `due_date`, `cost`, `description`, `status`) VALUES ('" . $session->id . "','$name','$startDate','$dueDate','$cost','$description','$status')") or
            die($database->query);
    }
    if (isset($_POST["googleCheck"])) {
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
        header("location:../../quickstart.php");
    } else {
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";

        header("location:tasks.php");
    }
}



if (isset($_GET['deleteTask'])) {
    $task_id = $_GET['deleteTask'];
    $database->query("DELETE FROM tasks WHERE`tasks`.`task_id`=$task_id") or
        die($database->query);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location:tasks.php");
}