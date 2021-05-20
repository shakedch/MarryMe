<?php require_once 'insertAndDelete.php';
global $session;
global $database;
$role = $_SESSION['role'];
$one_n = "My Tasks";
$sec_n = "Market";
$thr_n = "wishlist";
$inout = "Log Out";
$SeeCre = "See Your Account";
$where0 = "../tasksProcess/tasks.php";
$where1 = "../usersManagment/logOut.php";
$where2 = "../usersManagment/myAccount.php";
$where3 = "../marketAndOffers/market.php";
$where4 = "../wishList/wishList.php";
$user = new User();
$user->find_user_by_id($session->id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
    </script>
    <!-- BS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>

    <!--jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!--jQuery -->
    <!-- Icons -->
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <!-- Icons -->
    <!-- general fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&family=Josefin+Sans:wght@500&family=Niconne&display=swap" rel="stylesheet">
    <!-- general fonts-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript">
    </script>
    <script src="https://kit.fontawesome.com/90569433a0.js" crossorigin="anonymous"></script>

    <!-- our import files -->
    <script src="./formScripts.js"></script>
    <link rel="stylesheet" href="../../css/general.css">
    <link rel="stylesheet" href="../../css/taskStyle.css">


    <!-- our import files -->
    <!-- tab view -->
    <!-- tab view -->
    <link rel="shortcut icon" href="../../assets/img/tab_logo.png" type="image/png">
    <title> Marry Me - My Tasks</title>

</head>

<body>


    <div class="wrapper">
        <header class="fixed-top" id="nav">
            <?php include('../navbarTemplate.php') ?>
        </header>

        <div class="header">
            <div class="img-holder" data-image="../../assets/img/parallax_mytasks.png">
            </div>
            <div>
                <h1 id="myTasksTitle" class="head-text typographyH1">My Tasks</h1>
            </div>
        </div>
        <?php
        if (isset($_SESSION['message'])) :
        ?>

            <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif ?>
        <div>
            <div class="addTaskBtnWrapper">
                <button type="button" class="m-md-5 addTaskBtn" name="newTask" data-bs-toggle="modal" data-bs-target="#taskCreateModal"><i class="bi bi-plus addIcon"></i>Add
                    New Task</button>
            </div>



            <div id="cradListsWrapper" class="d-flex justify-content-around col-md-12">
                <?php
                $list = ['To Do', 'In Progress', 'Completed'];
                $listColor = ['background-color:#E47F74;', 'background-color:#EFA37E;', 'background-color:#9BAD69;'];
                // get currnt date
                date_default_timezone_set("Asia/Jerusalem");
                $today = date("Y-m-d H:i:s");






                // With this for loop, we will print all our lists (in this oreder) :
                // To do , In Progress, Completed.
                // Every round of the loop, we will print the next column.
                for ($i = 0; $i < sizeof($list); $i++) {
                    $listData = $database->query("SELECT * FROM tasks WHERE status='" . $list[$i] . "' AND user_id='" . $session->id . "'");
                ?>
                    <!-- each column will print from here. -->
                    <div class="card cardLists col-md-4 p-2">
                        <!-- IF - belong to the header list bg color -->
                        <?php if ($list[$i] == 'To Do') : ?>
                            <div class="card-header" style="background-color:#E47F74;">
                            <?php endif; ?>

                            <?php if ($list[$i] == 'In Progress') : ?>
                                <div class="card-header" style="background-color:#EFA37E;">
                                <?php endif; ?>
                                <?php if ($list[$i] == 'Completed') : ?>
                                    <div class="card-header" style="background-color:#9BAD69;">
                                    <?php endif; ?>

                                    <h2 class="cardListName"><?php echo $list[$i]; ?></h2>
                                    </div>
                                    <!-- All the cards will be print **from** here. -->
                                    <div class="card-body cardBodyScroll">
                                        <?php
                                        while ($row = $listData->fetch_assoc()) :
                                            if ($row['status'] == $list[$i]) : ?>
                                                <?php if ($list[$i] == 'To Do') : ?>
                                                    <div class="card mb-3 mt-3" style="border:2.3px solid #E47F74;">
                                                    <?php endif; ?>
                                                    <?php if ($list[$i] == 'In Progress') : ?>
                                                        <div class="card mb-3 mt-3" style="border:2.3px solid #EFA37E;">
                                                        <?php endif; ?>
                                                        <?php if ($list[$i] == 'Completed') : ?>
                                                            <div class="card mb-3 mt-3" style="border:2.3px solid #9BAD69;">
                                                            <?php endif; ?>

                                                            <input type="hidden" name='task_id' value=<?php echo $row['task_id']; ?>>
                                                            <div class="card-header text-center" style="background-color:white;">
                                                                <?php if ($row['due_date'] < $today && $list[$i] !== 'Completed') : ?>
                                                                    <i class="fas fa-exclamation-circle dateDanger"></i>
                                                                    <small class="dateDangerMsg">Due date passed!</small>
                                                                    <i class="fas fa-exclamation-circle dateDanger"></i>
                                                                <?php endif; ?>
                                                                <?php

                                                                $diff = round((strtotime($row['due_date']) - strtotime($today)) / (60 * 60 * 24));

                                                                ?>

                                                                <?php if ($diff == 1 && $list[$i] !== 'Completed') : ?>
                                                                    <i class="bi bi-alarm-fill dateWarning"></i>
                                                                    <small class="dateWarningMsg">One day to due date!</small>
                                                                    <i class="bi bi-alarm-fill dateWarning"></i>
                                                                <?php endif; ?>


                                                                <h5 class="viewDate" id="viewDate">
                                                                    Due date:
                                                                    <?php echo date('d/m/Y', strtotime(str_replace(':00', '', $row['due_date']))); ?>
                                                                </h5>
                                                            </div>
                                                            <div class="card-body text-center">
                                                                <h6 class="viewName"><?php echo $row['name']; ?></h6>
                                                            </div>
                                                            <div class="card-footer" style="background-color:white;">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <button class="btn information" data-bs-toggle="modal" data-bs-target="#taskViewModal<?php echo $row['task_id']; ?>">
                                                                        <i class="far fa-eye fa-lg information" style="color:#70bdf2">
                                                                        </i>
                                                                    </button>
                                                                    <button class="btn" name="delete" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['task_id']; ?>">
                                                                        <i class="fas fa-trash fa-lg" style="color:#b12531"></i></button>

                                                                    <span class="viewCost"><?php echo $row['cost'];  ?>$</span>

                                                                </div>
                                                            </div>
                                                            </div>
                                                            <!-- FORM VIEW/EDIT MODAL -->
                                                            <div class="modal fade" id='taskViewModal<?php echo $row['task_id']; ?>' data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content modalBorder">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title taskTitle" id="taskNameTypogrpahy">Task
                                                                                Name:
                                                                                <?php echo $row['name']; ?></h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <form name="editForm" id="editForm" onsubmit="checkInputs(event);event.preventDefault();" action="updateTask.php" method="POST" class="ajax" enctype="multipart/form-data">
                                                                            <div class="modal-body">
                                                                                <input type="hidden" name="task_id" value="<?php echo $row['task_id']; ?>">
                                                                                <div class='mb-3 nameDiv form-group'>
                                                                                    <label class="form-label lableTask" for='viewName'>Task
                                                                                        Name</label>
                                                                                    <input id="viewName" class="form-control name inputTask" type="text" name="viewName" value="<?php echo $row['name']; ?>" placeholder="Enter Task name" disabled>
                                                                                    <i class="fas fa-check-circle"></i>
                                                                                    <i class="fas fa-exclamation-circle"></i>
                                                                                    <small id="viewErrorName">Error message</small>
                                                                                </div>
                                                                                <div class="mb-3 form-group">
                                                                                    <label for="view_start_date" class="form-label lableTask ">Start
                                                                                        Date</label>
                                                                                    <input class="form-control inputTask" id="view_start_date" type="datetime-local" name="view_start_date" value="<?php echo str_replace(' ', 'T', $row['start_date']); ?>" disabled>
                                                                                    <i class="fas fa-check-circle"></i>
                                                                                    <i class="fas fa-exclamation-circle"></i>
                                                                                    <small id="viewErrorStartDate">Error message</small>
                                                                                </div>

                                                                                <div class="mb-3 form-group">
                                                                                    <label for="view_due_date" class="form-label lableTask">Due
                                                                                        Date</label>
                                                                                    <input class="form-control inputTask" type="datetime-local" name="view_due_date" id='view_due_date' value="<?php echo str_replace(' ', 'T', $row['due_date']); ?>" disabled>
                                                                                    <i class="fas fa-check-circle"></i>
                                                                                    <i class="fas fa-exclamation-circle"></i>
                                                                                    <small id="viewErrorDueDate">Error message</small>
                                                                                </div>
                                                                                <div class='mb-3 form-group'>
                                                                                    <label class="form-label lableTask" for='cost'>Cost
                                                                                        ($)</label>
                                                                                    <input id="cost" class="form-control inputTask " type="text" name="cost" value="<?php echo $row['cost']; ?>" disabled placeholder="Enter cost">
                                                                                    <i class="fas fa-check-circle"></i>
                                                                                    <i class="fas fa-exclamation-circle"></i>
                                                                                    <small id="viewErrorCost">Error message</small>
                                                                                </div>
                                                                                <div class="mb-3 form-group">
                                                                                    <label for="view_description" class="form-label lableTask">Description</label>
                                                                                    <textarea class="form-control descriptionTask" name="view_description" id='view_description' rows="3" disabled><?php echo $row['description']; ?></textarea>
                                                                                </div>
                                                                                <div class="mb-3 form-group">
                                                                                    <select id="view_status" name='view_status' class="form-select statusTask lableTask" disabled aria-label="Default select example">
                                                                                        <option value='' selected disabled hidden>Status
                                                                                        </option>
                                                                                        <option value="To Do" <?php if ($row['status'] == 'To Do') { ?> selected="selected" <?php } ?>>To Do
                                                                                        </option>
                                                                                        <option value="In Progress" <?php if ($row['status'] == 'In Progress') { ?> selected="selected" <?php } ?>>
                                                                                            In Progress</option>
                                                                                        <option value="Completed" <?php if ($row['status'] == 'Completed') { ?> selected="selected" <?php } ?>>
                                                                                            Completed</option>
                                                                                    </select>
                                                                                    <i class="fas fa-check-circle"></i>
                                                                                    <i class="fas fa-exclamation-circle"></i>
                                                                                    <small id="viewErrorStatus">Error message</small>
                                                                                </div>


                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn closeBtn" data-bs-dismiss="modal">Close</button>
                                                                                <a id="edit" href="tasks.php?edit=<?php echo $row['task_id']; ?>" data-task-id="<?php echo $row['task_id']; ?>" value="edit" class="btn btnEdit edit">Edit</a>

                                                                                <button type="submit" class="btn btnUpdate updatetask">Update</button>


                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- DELETE TASK MODAL -->

                                                            <div class="modal fade" id="deleteModal<?php echo $row['task_id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content modalBorder">
                                                                        <div class="modal-header deleteheader">
                                                                            <h5 class="modal-title taskTitle" id="removeTaskTypogrpahy">
                                                                                Remove
                                                                                Task
                                                                            </h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <form action="insertAndDelete.php" method="POST" enctype="multipart/form-data">
                                                                            <div class="modal-body">
                                                                                <input type="hidden" name="task_id" value="<?php echo $row['task_id']; ?>">
                                                                                <h4>Are you sure you want to delete this task?</h4>
                                                                            </div>
                                                                            <div class="modal-footer deletefooter">
                                                                                <button type="button" class="btn closeBtn" data-bs-dismiss="modal">No</button>
                                                                                <a id="deleteTask" name="deleteTask" href="insertAndDelete.php?deleteTask=<?php echo $row['task_id']; ?>" data-task-id="<?php echo $row['task_id']; ?>" value="deleteTask" class="btn btnYes deleteTask">Yes</a>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endwhile; ?>
                                                        </div>
                                                    </div>
                                                <?php
                                            };
                                                ?>
                                    </div>
                                </div>
                                <!-- Modal -->
                            </div>



                            <!-- FORM CREATE TASK MODAL -->
                            <div class="modal fade" id='taskCreateModal' data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content modalBorder">
                                        <div class="modal-header">
                                            <h4 class="modal-title taskTitle " id="newTaskTypogrpahy"> New Task
                                            </h4>
                                            <button onclick="changeClass()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form name="createForm" id="createForm" action="insertAndDelete.php" method="POST" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <input type="hidden" name="task_id">
                                                <script src="./taskBank.js"></script>

                                                <div class='mb-3 form-group'>
                                                    <input onclick="clickForMore()" class="form-check-input " type="checkbox" style="margin-top: 6px;" />
                                                    <label class="form-check-label lableTask">Check our
                                                        suggestions!</label>
                                                </div>

                                                <div id="showTaskBank" class='mb-3 form-group' style="display: none">
                                                    <select id="nameBank" name='nameBank' class="form-select statusTask lableTask">
                                                        <option selected disabled hidden>Choose Task</option>
                                                        <?php
                                                        $records = $database->query("SELECT * FROM tasksuggestions") or die($database->query);
                                                        while ($data = mysqli_fetch_array($records)) {
                                                            echo "<option value='" . $data['suggestion_name'] . "'>" . $data['suggestion_name'] . "</option>";  // displaying data in option menu
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div id="taskNameInput" class='mb-3 form-group'>
                                                    <label class="form-label lableTask" for='name'>Task Name</label>
                                                    <input class="form-control name inputTask" id="name" type="text" name="name" placeholder="Enter Task name">
                                                    <i class="fas fa-check-circle"></i>
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    <small id="errorName">Error message</small>
                                                </div>



                                                <div class='mb-3 form-group'>
                                                    <label for="start_date" class="form-label lableTask">Start Date</label>
                                                    <input id="start_date" class="form-control inputTask" type="datetime-local" name="start_date" value="<?php echo date('Y-m-d\TH:i'); ?>">
                                                    <i class="fas fa-check-circle"></i>
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    <small id="errorStartDate">Error message</small>

                                                </div>

                                                <div class='mb-3 form-group '>
                                                    <label for="due_date" class="form-label lableTask">Due Date</label>
                                                    <input class="form-control inputTask" type="datetime-local" name="due_date" id='due_date' value="<?php echo date('Y-m-d\TH:i'); ?>">
                                                    <i class="fas fa-check-circle"></i>
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    <small id="errorDueDate">Error message</small>
                                                </div>

                                                <div class='mb-3 form-group'>
                                                    <label class="form-label lableTask" for='cost'>Cost ($)</label>
                                                    <input class="form-control inputTask" id="createCost" type="text" value=0 name="cost" placeholder="Enter cost">
                                                    <i class="fas fa-check-circle"></i>
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    <small id="errorCost">Error message</small>
                                                </div>
                                                <div class="mb-3 form-group">
                                                    <label for="description" class="form-label lableTask">Description</label>
                                                    <textarea class="form-control descriptionTask" name="description" rows="3"></textarea>
                                                </div>
                                                <div class="mb-3 form-group">
                                                    <select id="status" name='status' class="form-select statusTask lableTask" aria-label="Default select example">
                                                        <option value='' selected disabled hidden>Status</option>
                                                        <option value="To Do">To Do
                                                        </option>
                                                        <option value="In Progress">
                                                            In Progress</option>
                                                        <option value="Completed">
                                                            Completed</option>
                                                    </select>
                                                    <i class="fas fa-check-circle"></i>
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    <small id="errorStatus">Error message</small>
                                                </div>

                                                <div class='mb-3 form-group'>
                                                    <input name="googleCheck" value="1" class="form-check-input " type="checkbox" style="margin-top: 6px;" />
                                                    <label for="googleCheck" class="form-check-label lableTask">Save to Google
                                                        Calender</label>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button onclick="changeClass()" type="button" class="btn closeBtn" data-bs-dismiss="modal">Close</button>

                                                <button type="submit" name="save" class="btn createTaskBtn">Save</button>


                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <footer>
                                <?php include('../footer.php') ?>
                            </footer>

                            <!-- Necessary scripts-->
                            <script src="https://rawgithub.com/pederan/Parallax-ImageScroll/master/jquery.imageScroll.min.js" type="text/javascript"></script>
                            <script src="../general.js"></script>
                            <script src="./taskCreateValidation.js"></script>
                            <script src="./taskEditValidation.js"></script>

</body>


</html>