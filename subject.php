<?php
require 'connection.php';

include 'header.php';

// INSERT DATA
if (isset($_POST['save'])) {

    $stmt = $conn->prepare("INSERT INTO subjects (subject_name,credit_hour) 
    VALUE(:subject_name,:credit_hour)");

    $stmt->bindValue('subject_name', $_POST['subject_name']);
    $stmt->bindValue('credit_hour', $_POST['credit_hour']);
    $stmt->execute();
    header("location:subject.php");
}

//DISPLAY DATA
$stmt = $conn->prepare("SELECT * FROM subjects ORDER BY subject_name ASC");
$stmt->execute();

//DELETE DATA
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $stmt = $conn->prepare("DELETE FROM subjects WHERE id=:id");
    $stmt->bindValue('id', $_GET['id']);
    $stmt->execute();
    header("location:subject.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Add Subject</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <h3>Subject List</h3>
                <p class="text-start">In this page, you can manage or add new semester for your students</p>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject Name</th>
                            <th>Credit Hour</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        while ($subjects = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                            <tr>
                                <td class="data-content"><?php echo $subjects->id; ?></td>
                                <td class="data-content"><?php echo $subjects->subject_name; ?></td>
                                <td class="data-content"><?php echo $subjects->credit_hour; ?></td>
                                <td class="data-content">
                                    <a class="btn btn-secondary" href="edit.php?id=<?php echo $subjects->id ?>">Edit</a>
                                    <a class="btn btn-danger" href="subject.php?id=<?php echo $subjects->id ?> &action=delete">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </thead>
                </table>
            </div>

            <div class="col-sm">
                <div class="container">
                    <div class="shadow p-3 mb-5 bg-body rounded">
                        <form action="" method="post">
                            <h4>Add New Subjects</h4>
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label class="form-label" for="subject_name">Subject Name: </label>
                                    <input type="text" name="subject_name" value="" id="subject_name" class="form-control" placeholder="Insert Subject Name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="credit_hour">Credit Hour: </label>
                                    <input type="text" name="credit_hour" value="" id="credit_hour" class="form-control" placeholder="Insert Subject Credit Hour">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="save" value="save" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>












</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</html>