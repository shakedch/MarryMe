<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- BS -->
    <title>MarryMe-myTasks</title>
</head>

<body>
    <?php require_once 'process.php'; ?>

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
        <?php
        $mysqli = new mysqli("localhost", "root", "", "marryme") or die(mysqli_error(($mysqli)));
        $result = $mysqli->query("SELECT * FROM tasks") or die($mysqli->error);
        // show how much records
        // pre_r($result);
        // fetch record from db
        // pre_r($result->fetch_assoc());
        ?> <div class=" d-flex justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>start date</th>
                        <th>due date</th>
                        <th>cost</th>
                        <th>description</th>
                        <th>status</th>
                        <th>attached file</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php
                while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['t_name']; ?></td>
                    <td><?php echo $row['t_start_date']; ?></td>
                    <td><?php echo $row['t_due_date']; ?></td>
                    <td><?php echo $row['t_cost']; ?></td>
                    <td><?php echo $row['t_description']; ?></td>
                    <td><?php echo $row['t_status']; ?></td>
                    <td><?php echo $row['t_attached_files']; ?></td>
                    <td>
                        <a href="myTasks.php?edit=<?php echo $row["tr_id"]; ?>" class="btn btn-info">Edit</a>

                        <a href="process.php?delete=<?php echo $row["tr_id"]; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
        <?php
        function pre_r($array)
        {
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }
        ?> <div class='d-flex justify-content-center'>
            <form action="process.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class='mb-3'>
                    <label class="form-label" for='name'>Task Name</label>
                    <input class="form-control" type="text" name="name" value="<?php echo $name; ?>"
                        placeholder="Enter Task name">
                </div>
                <div class="form-group row">
                    <label for="startDate" class="col-2 col-form-label">Start Date</label>
                    <div class="col-10">
                        <input class="form-control" type="datetime-local" name="startDate" value="">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="dueDate" class="col-2 col-form-label">Due Date</label>
                    <div class="col-10">
                        <input class="form-control" type="datetime-local" name="dueDate" value="">
                    </div>
                </div>
                <div class='mb-3'>
                    <label class="form-label" for='cost'>Cost</label>
                    <input class="form-control" type="text" name="cost" value="<?php echo $name; ?>"
                        placeholder="Enter cost">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3"></textarea>
                </div>
                <select name='status' class="form-select" aria-label="Default select example">
                    <option selected disabled>Status</option>
                    <option value="1">To Do</option>
                    <option value="2">In Progress</option>
                    <option value="3">Completed</option>
                </select>
                <br>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="attachedFile">Upload</label>
                    <input type="file" name="attachedFile" class="form-control" id="inputGroupFile02">
                </div>
                <?php
                if ($update == true) :
                ?>
                <button type="submit" class="btn btn-info" name="update">Update</button>
                <?php else : ?>
                <button type="submit" class="btn btn-primary" name="save">save</button>
                <?php endif; ?>
            </form>
        </div>
    </div>

</body>

</html>