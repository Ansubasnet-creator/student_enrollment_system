<?php
require "../config/db.php";

$stmt = $pdo->prepare("DELETE FROM student_enrollment WHERE id=?");
$stmt->execute([$_GET['id']]);

header("Location: index.php");
