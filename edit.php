<?php
require 'connection.php';
include 'header.php';

//////////////////////////////////////////////////////EDIT SUBJECT////////////////////////////////////////////

//ACCESS STUDENT DATA BY ID

//ACCESS BOOK DATA BY ID
//ENABLE DATA BE FETCH FOR UPDATE
$stmt = $conn->prepare('SELECT * FROM subjects WHERE id=:id');
$stmt->bindValue('id', $_GET['id']);
$stmt->execute();

$subjects = $stmt->fetch(PDO::FETCH_OBJ);

if (isset($_POST['save'])) {


    $stmt = $conn->prepare("UPDATE subjects SET subject_name=:subject_name, credit_hour=:credit_hour 
    WHERE id=:id");
    $stmt->bindValue('id', $_POST['id']);
    $stmt->bindValue('subject_name', $_POST['subject_name']);
    $stmt->bindValue('credit_hour', $_POST['credit_hour']);

    $stmt->execute();
    header("Location:subject.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Edit Subject</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="container">
                    <div class="mb-3">
                        <form action="" method="post">
                            <fieldset>
                                <h3>Edit Subject Detail</h3>
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
                                                    <input type="text" readonly class="form-control-plaintext" id="id" value="<?php echo $subjects->id; ?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Subject Name</td>
                                            <td><input class=" form-control" type="text" name="subject_name" value="<?php echo $subjects->subject_name; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Credit Hour</td>
                                            <td><input class="form-control" type="text" name="credit_hour" value="<?php echo $subjects->credit_hour; ?>"></td>
                                        </tr>
                                        <tr>
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
    </div>





</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</html>