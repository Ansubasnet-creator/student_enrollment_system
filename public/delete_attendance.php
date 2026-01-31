<?php
require_once "../config/auth.php";
require_once "../config/db.php";

$id = $_GET['id'];
$conn->query("DELETE FROM attendance WHERE id=$id");

header("Location: attendences.php");
exit;
