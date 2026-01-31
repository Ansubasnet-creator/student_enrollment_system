<?php
require_once "../config/auth.php";
require_once "../config/db.php";

$id = $_GET['id'];
$conn->query("DELETE FROM grades WHERE id=$id");

header("Location: grades.php");
exit;
