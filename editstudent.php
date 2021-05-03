<?php
require 'connection.php';
include 'header.php';

$stmt = $conn->prepare('SELECT * FROM students WHERE id=:id');
$stmt->bindValue('id', $_GET['id']);
$stmt->execute();

$students = $stmt->fetch(PDO::FETCH_OBJ);

if (isset($_POST['save'])) {


    $stmt = $conn->prepare("UPDATE students SET full_name=:full_name, age=:age, matric_no=:matric_no, course=:course
    WHERE id=:id");
    $stmt->bindValue('id', $_POST['id']);
    $stmt->bindValue('full_name', $_POST['full_name']);
    $stmt->bindValue('age', $_POST['age']);
    $stmt->bindValue('matric_no', $_POST['matric_no']);
    $stmt->bindValue('course', $_POST['course']);


    $stmt->execute();
    header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Edit Student Detail</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="container">

                    <form action="" method="post">
                        <fieldset>
                            <h3>Edit Student Detail</h3>
                            <div class="shadow p-3 mb-5 bg-body rounded">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <div class="mb-3 row">
                                                <label for="id" class="col-sm-2 col-form-label">ID</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-sm-10">
                                                <input type="text" readonly class="form-control-plaintext" id="id" value="<?php echo $students->id; ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Full Name: </td>
                                        <td><input class="form-control" type="text" name="full_name" value="<?php echo $students->full_name; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Age: </td>
                                        <td><input class="form-control" type="text" name="age" value="<?php echo $students->age; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Matric Number: </td>
                                        <td><input class="form-control" type="text" name="matric_no" value="<?php echo $students->matric_no; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Course: </td>
                                        <td><input class="form-control" type="text" name="course" value="<?php echo $students->course; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><input class="btn btn-primary" type="submit" name="save" value="Update"></td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>





</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</html>