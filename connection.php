<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "studentgrade";

//CREATE CONNECTION FOR DB
$dsn = 'mysql:host=localhost; dbname=studentgrade';

$conn = new PDO('mysql:host=localhost; dbname=studentgrade', 'root', '');
