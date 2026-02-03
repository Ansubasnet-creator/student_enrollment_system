<?php
require_once "../config/auth.php";
require_once "../config/db.php";

$id = $_GET['id'];
$conn->query("DELETE FROM students WHERE id=$id");

header("Location: students.php");
exit;