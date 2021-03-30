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
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['start_date']; ?></td>
                    <td><?php echo $row['due_date']; ?></td>
                    <td><?php echo $row['cost']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['attached_file']; ?></td>
                    <td>
                        <!--Need rewrite the ID's in the links buttons to the PK's when it will be done. -->
                        <a href="myTasks.php?" class="btn btn-info">Edit</a>
                        <a href="process.php? " class="btn btn-danger" name="delete">Delete</a>
                        <!--Need rewrite the ID's in the links buttons to the PK's when it will be done. -->
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
        ?>
        <div class='d-flex justify-content-center'>
            <form action="process.php" method="POST">
                <div class='mb-3'>
                    <label class="form-label" for='name'>Task Name</label>
                    <input class="form-control" type="text" name="name" value="<?php echo $name; ?>"
                        placeholder="Enter Task name">
                </div>
                <div class="form-group row">
                    <label for="start_date" class="col-2 col-form-label">Start Date</label>
                    <div class="col-10">
                        <input class="form-control" type="datetime-local" name="start_date" value="">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="due_date" class="col-2 col-form-label">Due Date</label>
                    <div class="col-10">
                        <input class="form-control" type="datetime-local" name="due_date" value="">
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
                    <option value="toDo">To Do</option>
                    <option value="inProgress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
                <br>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="attached_file">Upload</label>
                    <input type="file" name="attached_file" class="form-control" id="inputGroupFile02">
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