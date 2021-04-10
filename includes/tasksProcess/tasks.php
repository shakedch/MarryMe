<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- BS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <!-- BS -->
    <!--jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!--jQuery -->
    <!-- Icons -->
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <!-- Icons -->
    <!-- our import files -->
    <script src="./formScripts.js"></script>
    <link rel="stylesheet" href="../css/taskStyle.css">
    <!-- our import files -->

    <title>MarryMe-Tasks</title>

</head>

<body>

    <?php require_once 'insertAndDelete.php'; ?>
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
    <div class="container">
        <div class="text-left">
            <button type="button" class="m-md-5 btn btn-primary" name="newTask" data-bs-toggle="modal"
                data-bs-target="#taskModal">Add
                New Task</button>
            <div class="d-flex justify-content-between col-md-12">
                <?php
                $list = ['To Do', 'In Progress', 'Completed'];
                // With this for loop, we will print all our lists (in this oreder) :
                // To do , In Progress, Completed.
                // Every round of the loop, we will print the next column.
                for ($i = 0; $i < sizeof($list); $i++) {
                    $listData = $mysqli->query("SELECT * FROM tasks WHERE tasks.status='$list[$i]'") or die($mysqli->error);
                ?>
                <!-- each column will print from here. -->
                <div class="card col-md-4 p-2">
                    <div class="card-header">
                        <h3><?php echo $list[$i]; ?></h3>
                    </div>
                    <!-- All the cards will be print **from** here. -->
                    <div class="card-body">
                        <?php
                            while ($row = $listData->fetch_assoc()) :
                                if ($row['status'] == $list[$i]) : ?>
                        <div class="card mb-3 mt-3">
                            <input type="hidden" name='task_id' value=<?php echo $row['task_id']; ?>>
                            <div class="card-header text-center">
                                <h5>Due date:
                                    <?php echo date('d/m/Y', strtotime(str_replace(':00', '', $row['due_date']))); ?>
                                </h5>
                            </div>
                            <div class="card-body text-center">
                                <h6><?php echo $row['name']; ?></h6>
                                <label for="description">Description</label>
                                <p><?php echo $row['description']; ?></p>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <button class="btn" data-bs-toggle="modal"
                                        data-bs-target="#taskModal<?php echo $row['task_id']; ?>">
                                        <ion-icon class="information" size="large" name="information-circle-outline">
                                        </ion-icon>
                                    </button>
                                    <button class="btn" name="delete" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal<?php echo $row['task_id']; ?>"><i
                                            class="bi bi-trash"></i></button>

                                    <span>Cost: <?php echo $row['cost']; ?></span>
                                </div>
                            </div>
                        </div>
                        <!-- FORM VIEW/EDIT MODAL -->
                        <div class="modal fade" id='taskModal<?php echo $row['task_id']; ?>' tabindex="-1"
                            aria-labelledby="taskModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Task Name:
                                            <?php echo $row['name']; ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="updateTask.php" onsubmit="validateCost(event);" method="POST"
                                        class="ajax" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <input type="hidden" name="task_id" value="<?php echo $row['task_id']; ?>">
                                            <div class='mb-3 nameDiv'>
                                                <label class="form-label" for='name'>Task Name</label>
                                                <input class="form-control name" id="<?php echo $row['task_id']; ?>"
                                                    type="text" name="name" value="<?php echo $row['name']; ?>"
                                                    placeholder="Enter Task name" disabled required>
                                            </div>
                                            <div class="form-group row">
                                                <label for="start_date" class="col-2 col-form-label">Start Date</label>
                                                <div class="col-10">
                                                    <input class="form-control" type="datetime-local" name="start_date"
                                                        value="<?php echo str_replace(' ', 'T', $row['start_date']); ?>"
                                                        disabled onchange="getStartDateTask(this.value)" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="due_date" class="col-2 col-form-label">Due Date</label>
                                                <div class="col-10">
                                                    <input class="form-control" type="datetime-local" name="due_date"
                                                        id='due_date'
                                                        value="<?php echo str_replace(' ', 'T', $row['due_date']); ?>"
                                                        disabled required>
                                                </div>
                                            </div>
                                            <div class='mb-3'>
                                                <label class="form-label" for='cost'>Cost</label>
                                                <input id="cost" class="form-control" type="text" name="cost"
                                                    value="<?php echo $row['cost']; ?>" disabled
                                                    placeholder="Enter cost">
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" name="description" rows="3"
                                                    disabled><?php echo $row['description']; ?></textarea>
                                            </div>
                                            <select name='status' class="form-select" disabled
                                                aria-label="Default select example" required>
                                                <option value='' selected disabled hidden>Status</option>
                                                <option value="To Do" <?php if ($row['status'] == 'To Do') { ?>
                                                    selected="selected" <?php } ?>>To Do
                                                </option>
                                                <option value="In Progress"
                                                    <?php if ($row['status'] == 'In Progress') { ?> selected="selected"
                                                    <?php } ?>>
                                                    In Progress</option>
                                                <option value="Completed" <?php if ($row['status'] == 'Completed') { ?>
                                                    selected="selected" <?php } ?>>
                                                    Completed</option>
                                            </select>
                                            <br>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <a id="edit" href="tasks.php?edit=<?php echo $row['task_id']; ?>"
                                                data-task-id="<?php echo $row['task_id']; ?>" value="edit"
                                                class="btn btn-info edit">Edit</a>

                                            <button type="submit" class="btn btn-info updatetask">Update</button>


                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- DELETE TASK MODAL -->

                        <div class="modal fade" id="deleteModal<?php echo $row['task_id']; ?>" tabindex="-1"
                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Remove Task</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="insertAndDelete.php" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <input type="hidden" name="task_id" value="<?php echo $row['task_id']; ?>">
                                            <h4>Are you sure you want to delete this task?</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">No</button>
                                            <a id="deleteTask" name="deleteTask"
                                                href="insertAndDelete.php?deleteTask=<?php echo $row['task_id']; ?>"
                                                data-task-id="<?php echo $row['task_id']; ?>" value="deleteTask"
                                                class="btn btn-primary deleteTask">Yes</a>
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
    <div class="modal fade" id='taskModal' tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Task Name:
                        <?php echo $row['name']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form onsubmit="validateCost(event);" action="insertAndDelete.php" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="task_id">
                        <div class='mb-3'>
                            <label class="form-label" for='name'>Task Name</label>
                            <input class="form-control name" id="name" type="text" name="name"
                                placeholder="Enter Task name" required>
                        </div>
                        <div class="form-group row">
                            <label for="start_date" class="col-2 col-form-label">Start Date</label>
                            <div class="col-10">
                                <input class="form-control" type="datetime-local" name="start_date"
                                    value="<?php echo date('Y-m-d\TH:i'); ?>" onchange="getStartDateTask(this.value)"
                                    required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="due_date" class="col-2 col-form-label">Due Date</label>
                            <div class="col-10">
                                <input class="form-control" type="datetime-local" name="due_date" id='due_date'
                                    value="<?php echo date('Y-m-d\TH:i'); ?>" required>
                            </div>
                        </div>
                        <div class='mb-3'>
                            <label class="form-label" for='cost'>Cost</label>
                            <input class="form-control" id="cost" type="text" name="cost" placeholder="Enter cost">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                        <select name='status' class="form-select" aria-label="Default select example" required>
                            <option value='' selected disabled hidden>Status</option>
                            <option value="To Do">To Do
                            </option>
                            <option value="In Progress">
                                In Progress</option>
                            <option value="Completed">
                                Completed</option>
                        </select>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <button type="submit" name="save" class="btn btn-info createNewTask">Save</button>


                    </div>
                </form>
            </div>
        </div>
    </div>







</body>


</html>