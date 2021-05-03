<?php
require 'connection.php';

include 'header.php';

// INSERT DATA FOR SEMESTER
if (isset($_POST['save'])) {

    $stmt = $conn->prepare('INSERT INTO semesters (sem_name) 
    VALUE(:sem_name)');

    $stmt->bindValue('sem_name', $_POST['sem_name']);

    $stmt->execute();
    header("location:semester.php");
}

//DISPLAY DATA FOR SEMESTER
$stmt = $conn->prepare('SELECT * FROM semesters');
$stmt->execute();

//DELETE DATA FOR SEMESTER
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $stmt = $conn->prepare('DELETE FROM semesters WHERE id=:id');
    $stmt->bindValue('id', $_GET['id']);
    $stmt->execute();
    header("location:semester.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Add Semester</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="container">
                    <h2>Semester List</h2>
                    <p class="text-start">In this page, you can manage or add new semester for your students</p>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Semester Name</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            while ($semesters = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                                <tr>
                                    <td class="data-content"><?php echo $semesters->sem_name; ?></td>
                                    <td class="data-content">
                                        <a class="btn btn-danger" href="semester.php?id=<?php echo $semesters->id ?> &action=delete">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="col-sm">
                <div class="container">
                    <div class="shadow p-3 mb-5 bg-body rounded">
                        <form action="" method="post">
                            <h4>Add New Semester</h4>
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label class="form-label" for="sem_name">Semester Name: </label>
                                    <input type="text" name="sem_name" value="" id="sem_name" class="form-control" placeholder="Insert Semester Name">
                                </div>
                            </div>

                            <!-- <div class="mb-3">
                    <div class="form-label">Semester Name</div>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="Semester 1">Semester 1</option>
                        <option value="Semester 2">Semester 2</option>
                        <option value="Semester 3">Semester 3</option>
                        <option value="Semester 4">Semester 4</option>
                        <option value="Semester 5">Semester 5</option>
                        <option value="Semester 6">Semester 6</option>
                        <option value="Semester 7">Semester 7</option>
                        <option value="Semester 8">Semester 8</option>
                    </select>
                </div> -->
                            <div class="mb-3">
                                <button type="submit" name="save" value="save" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</html>