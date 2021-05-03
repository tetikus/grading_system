<?php
require "connection.php";
include 'header.php';


//////////////////////////////////////////////////////RESULTS ADD SECTION/////////////////////////////////////////////
if (isset($_POST['save'])) {

    $sql = "INSERT INTO results (student_id, semester_id, subject_id, pointer, grade) 
    VALUE(:student_id, :semester_id, :subject_id, :pointer, :grade)";


    $stmt = $conn->prepare($sql);
    $stmt->bindValue('student_id', $_POST['student_id']);
    $stmt->bindValue('semester_id', $_POST['semester_id']);
    $stmt->bindValue('subject_id', $_POST['subject_id']);
    $stmt->bindValue('pointer', $_POST['pointer']);
    $stmt->bindValue('grade', $_POST['grade']);

    $stmt->execute();
}


// UPDATE RESULT
// 1st Check current student dah ada result untuk selected subject ke belum

// If yes -> Update table results with student_id = current student id & subject_id = selected subject id
// UPDATE results ....... WHERE student_id=$_GET['id'] AND subject_id = $_POST['subject_id']

// If no -> Insert new result
// $stmt = $conn->prepare('INSERT INTO results(sem_name) VALUE(:sem_name)');
// $stmt->bindValue('sem_name', $_POST['sem_name']);
// $stmt->execute();
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>

<body>
    <!--BSTUDENT DETAIL PART -->
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                    </div>

                    <!--FORM TO ADD STUDENT RESULTS -->
                    <div class="col-sm-12">
                        <div class="mb-3">
                            <h3>Manage Result</h3>
                            <p>Add Student Result Detail Here</p>
                            <div class="shadow p-3 mb-5 bg-body rounded">

                                <form action="" method="post">

                                    <div class="mb-3">
                                        <label class="form-label" for="student">Student: </label>

                                        <?php
                                        $stmt = $conn->prepare('SELECT * FROM students');
                                        $stmt->execute();
                                        ?>
                                        <select name="student_id" class="form-select" aria-label="student">
                                            <option selected>Select Student</option>
                                            <?php while ($student = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                                                <option value="<?= $student->id ?>"><?= $student->full_name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="semester">Semester: </label>

                                        <?php
                                        $stmt = $conn->prepare('SELECT * FROM semesters');
                                        $stmt->execute();
                                        ?>
                                        <select name="semester_id" class="form-select" aria-label="semester">
                                            <option selected>Select Semester</option>
                                            <?php while ($semester = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                                                <option value="<?= $semester->id ?>"><?= $semester->sem_name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="subject">Subject: </label>

                                        <?php
                                        $stmt = $conn->prepare('SELECT * FROM subjects');
                                        $stmt->execute();
                                        ?>
                                        <select name="subject_id" class="form-select" aria-label="subject" required>
                                            <option selected required>Select Subject</option>
                                            <?php while ($subject = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                                                <option value="<?= $subject->id ?>"><?= $subject->subject_name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="pointer">Pointer: </label>
                                        <input type="text" name="pointer" value="" id="pointer" class="form-control" placeholder="Pointer" required>
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label class="form-label" for="grade">Grade: </label>
                                        <input type="text" name="grade" value="" id="grade" class="form-control" placeholder="Grade" required>
                                    </div> -->
                                    <div class="mb-3">
                                        <div class="form-label">Grade:</div>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="A">A</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B">B</option>
                                            <option value="B-">B-</option>
                                            <option value="C+">C+</option>
                                            <option value="C">C</option>
                                            <option value="C-">C-</option>
                                            <option value="D+">D</option>
                                            <option value="D">D+</option>
                                            <option value="E">E</option>
                                            <option value="F">F</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="save" value="save" class="btn btn-primary">Save</button>
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