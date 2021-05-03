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
    <h3 class="text-center">Add Student Detail</h3>
    <p class="text-center">In this page, you can insert new student detail in the system</p>


    <div class="container mx-auto">
        <div class="row">
            <div class="col-sm">
                <div class="shadow p-3 mb-5 bg-body rounded">

                    <form action="" method="post">
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="full_name">Full Name: </label>
                                <input type="text" name="full_name" value="" id="full_name" class="form-control" placeholder="Insert Student Name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="age">Age: </label>
                                <input type="text" name="age" value="" id="age" class="form-control" placeholder="Insert Student Age">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="matric_no">Matric No: </label>
                                <input type="text" name="matric_no" value="" id="matric_no" class="form-control" placeholder="Insert Student Matric No">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="course">Course: </label>
                                <input type="text" name="course" value="" id="course" class="form-control" placeholder="Insert Student Course">
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





</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</html>