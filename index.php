<?php
require 'connection.php';
include 'header.php';

// INSERT DATA
if (isset($_POST['save'])) {
    $stmt = $conn->prepare('INSERT INTO students(full_name,age,matric_no,course) VALUE(:full_name,:age,:matric_no,:course)');

    $stmt->bindValue('full_name', $_POST['full_name']);
    $stmt->bindValue('age', $_POST['age']);
    $stmt->bindValue('matric_no', $_POST['matric_no']);
    $stmt->bindValue('course', $_POST['course']);


    $stmt->execute();
    header("location:index.php");
}
//DELETE DATA
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $stmt = $conn->prepare('DELETE FROM students WHERE id=:id');
    $stmt->bindValue('id', $_GET['id']);
    $stmt->execute();

    echo "Data Deleted Succesfully";
}

//DISPLAY DATA
$stmt = $conn->prepare('SELECT * FROM students');
$stmt->execute();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Student Grading System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>

<body>

    <div class="container">
        <fieldset>
            <h2>Student Grading System</h2>
            <table class="table table-striped table-bordered table-hover shadow p-3 mb-5 bg-body rounded">
                <thead class="table-dark">
                    <tr>
                        <th>Full Name</th>
                        <th>Age</th>
                        <th>Matric No</th>
                        <th>Course</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($student = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                        <tr>
                            <td class="data-content"><?php echo $student->full_name; ?></td>
                            <td class="data-content"><?php echo $student->age; ?></td>
                            <td class="data-content"><?php echo $student->matric_no; ?></td>
                            <td class="data-content"><?php echo $student->course; ?></td>
                            <td class="data-content">
                                <a class="btn btn-primary" href="result.php?id=<?php echo $student->id ?>">View</a>
                                <a class="btn btn-secondary" href="editstudent.php?id=<?php echo $student->id ?>">Edit</a>
                                <a class="btn btn-danger" href="index.php?id=<?php echo $student->id ?> &action=delete">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </fieldset>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</html>