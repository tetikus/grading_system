<?php
require "connection.php";
include 'header.php';


//ACCESS RESULTS DATA BY ID
$stmt = $conn->prepare('SELECT * FROM students WHERE id=:id');
$stmt->bindValue('id', $_GET['id']);
$stmt->execute();
$student = $stmt->fetch(PDO::FETCH_OBJ);

// TO DELETE RESULT
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $stmt = $conn->prepare('DELETE FROM results
    WHERE id=:id');

    $stmt->bindValue('id', $_GET['id']);
    $stmt->execute();
    header("location:index.php");
}

///////// VIEW SELECT //////
if (isset($_POST['select'])) {

    $stmt = $conn->prepare($sql5);
    $stmt->bindValue('student_id', $_POST['student_id']);
    $stmt->bindValue('semester_id', $_POST['semester_id']);
    $stmt->bindValue('subject_id', $_POST['subject_id']);
    $stmt->bindValue('pointer', $_POST['pointer']);
    $stmt->bindValue('grade', $_POST['grade']);

    $stmt->execute();
}

//QUERY FOR DISPLAY RESULT STUDENT//
$sql = ("SELECT students.*, semesters.*, subjects.*, results.*
FROM results
INNER JOIN subjects ON results.subject_id = subjects.id
INNER JOIN semesters ON results.semester_id = semesters.id
INNER JOIN students ON results.student_id = students.id
WHERE student_id = :id
ORDER BY sem_name ASC ");

$stmt = $conn->prepare($sql);

$stmt->bindValue('id', $_GET['id']);
$stmt->execute();
$results = $stmt->fetch(PDO::FETCH_OBJ);


///////////////////////////////////////QUERY TO CALCULATE TOTAL CGPA/////////////////////////////////////
$sql2 = ("SELECT
SUM(subjects.credit_hour * results.pointer) / SUM(subjects.credit_hour) AS total
FROM results
INNER JOIN subjects ON results.subject_id = subjects.id
INNER JOIN students ON results.student_id = students.id
INNER JOIN semesters ON results.semester_id = semesters.id
WHERE student_id = :id");

$res = $conn->prepare($sql2);
$res->bindValue('id', $_GET['id']);
$res->execute();
// for ($i = 0; $rows = $res->fetch(); $i++) {
//     echo $rows['total'];
// }

///////////////////////////////////////QUERY TO CALCULATE TOTAL GPA/////////////////////////////////////

$sql3 = ("SELECT
SUM(subjects.credit_hour * results.pointer) / SUM(subjects.credit_hour) AS tgpa
FROM results
INNER JOIN subjects ON results.subject_id = subjects.id
INNER JOIN students ON results.student_id = students.id
INNER JOIN semesters ON results.semester_id = semesters.id
WHERE student_id = :id
GROUP BY sem_name
ORDER BY sem_name
");

$gpa = $conn->prepare($sql3);
$gpa->bindValue('id', $_GET['id']);
$gpa->execute();

///////////////////////////////////////QUERY TO DISPLAY SEMESTER////////////////////////////////////
$sql4 = ("SELECT (results.semester_id) AS sem
FROM results 
INNER JOIN subjects ON results.subject_id = subjects.id
INNER JOIN students ON results.student_id = students.id
INNER JOIN semesters ON results.semester_id = semesters.id
WHERE student_id = :id
GROUP BY sem_name
");

$sems = $conn->prepare($sql4);
$sems->bindValue('id', $_GET['id']);
$sems->execute();

///////////////////////////////QUERY TO VIEW RESULT VIA SEMESTER/////////////////////////
//QUERY FOR DISPLAY RESULT STUDENT//
$sql5 = ("SELECT students.*, semesters.*, subjects.*, results.*
FROM results
INNER JOIN subjects ON results.subject_id = subjects.id
INNER JOIN semesters ON results.semester_id = semesters.id
INNER JOIN students ON results.student_id = students.id
WHERE student_id = :id
GROUP BY sem_name");

$sel = $conn->prepare($sql5);

$sel->bindValue('id', $_GET['id']);
$sel->execute();
$selects = $sel->fetch(PDO::FETCH_OBJ);


////////////////////////////////////////////// LAIN-LAIN/////////////////////////////////////////
// foreach ($conn->query($sql1) as $row) {

//     echo "$row[total]";
// }

// $stmt = $conn->prepare("$sql");
// $stmt->bindValue('id', $_GET['id']);
// $stmt->execute();
// $cal = $stmt->fetch(PDO::FETCH_OBJ);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <h3>Student Detail</h3>

                <dl class="container">
                    <dt class="col-sm-3">Full Name</dt>
                    <dd class="col-sm-9"><?php echo $student->full_name; ?></dd>

                    <dt class="col-sm-3">Age</dt>
                    <dd class="col-sm-9"><?php echo $student->age; ?></dd>

                    <dt class="col-sm-3">Matric Number</dt>
                    <dd class="col-sm-9"><?php echo $student->matric_no; ?></dd>

                    <dt class="col-sm-3">Course</dt>
                    <dd class="col-sm-9"><?php echo $student->course; ?></dd>
                </dl>
            </div>

            <div class="col-sm">
                <div class="container">
                    <div class="shadow-sm p-3 mb-5 bg-body rounded">

                        <h4>Result</h4>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Semester</th>
                                    <th>GPA Result</th>
                                    <th>CGPA Results</th>
                                </tr>
                                <tr>
                                    <td>
                                        <?php
                                        for ($i = 0; $rows = $sems->fetch(); $i++) {
                                            echo "Semester " . $rows['sem'];
                                            echo "<br />";
                                        } ?>

                                    </td>
                                    <td class="data-content">
                                        <?php
                                        for ($i = 0; $rows = $gpa->fetch(); $i++) {
                                            echo (round($rows['tgpa']));
                                            echo "<br />";
                                        } ?>
                                    </td>

                                    <td class="data-content">
                                        <?php
                                        for ($i = 0; $rows = $res->fetch(); $i++) {
                                            echo "Total: " . (round($rows['total']));
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-----------------------------------------------------------VIEW RESULT TABLE VIA SEMESTER -------------------------------------------------->
    <!--PART STILL DIDNT FINISH YET SINCE CANNOT DISPLAY THE SELECTED OPTION   -    ---->
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <form action="">
                    <select name="sem_name" class="form-select" aria-label="semester">
                        <option selected required>Select Semester To View // Can't display yet</option>

                        <?php while ($selects = $sel->fetch(PDO::FETCH_OBJ)) { ?>
                            <option value="<?= $selects->student_id ?>"><?= $selects->sem_name ?></option>
                        <?php } ?>
                    </select>
            </div>
            <div class="col-sm">
                <div class="mb-3">
                    <button type="select" name="select" value="select" class="btn btn-primary">View</button>
                </div>
            </div>
            </form>
        </div>
    </div>


    <!-- <div class="container">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Result ID</th>
                    <th>Semester</th>
                    <th>Subject</th>
                    <th>Credit Hour</th>
                    <th>Pointer</th>
                    <th>Grade</th>
                    <th>Action</th>
                </tr>
                <?php
                while ($selects = $sel->fetch(PDO::FETCH_OBJ)) { ?>
                    <tr>
                        <td class="data-content"><?php echo $selects->id; ?></td>
                        <td class="data-content"><?php echo $selects->sem_name; ?></td>
                        <td class="data-content"><?php echo $selects->subject_name; ?></td>
                        <td class="data-content"><?php echo $selects->credit_hour; ?></td>
                        <td class="data-content"><?php echo $selects->pointer; ?></td>
                        <td class="data-content"><?php echo $selects->grade; ?></td>
                    </tr>
                <?php } ?>
            </thead>
        </table>
    </div> -->

    <!---------------------------------------------------------------VIEW RESULT TABLE---------------------------------------------------->
    <div class="container">
        <fieldset>
            <div class="shadow p-3 mb-5 bg-body rounded">
                <h3>Results List</h3>
                <table class="table table-bordered table-striped border border-1">
                    <thead>
                        <tr>
                            <th>Result ID</th>
                            <th>Semester</th>
                            <th>Subject</th>
                            <th>Credit Hour</th>
                            <th>Pointer</th>
                            <th>Grade</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        while ($results = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                            <tr>
                                <td class="data-content"><?php echo $results->id; ?></td>
                                <td class="data-content"><?php echo $results->sem_name; ?></td>
                                <td class="data-content"><?php echo $results->subject_name; ?></td>
                                <td class="data-content"><?php echo $results->credit_hour; ?></td>
                                <td class="data-content"><?php echo $results->pointer; ?></td>
                                <td class="data-content"><?php echo $results->grade; ?></td>
                                <td class="data-content">
                                    <a class="btn btn-danger" href="result.php?id=<?php echo $results->id ?> &action=delete">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </thead>
                </table>
            </div>
        </fieldset>
    </div>










</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</html>