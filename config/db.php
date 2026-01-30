<?php
$host = "localhost";
$user = "root";       // change if needed
$password = "";       // set your MySQL password
$database = "student_enrollment";

$con = mysqli_connect($host, $user, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}