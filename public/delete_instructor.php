<?php
require_once "../config/auth.php";
require_once "../config/db.php";

$id = (int)$_GET['id'];

// Check if any students are linked to this instructor
$stmt = $conn->prepare("SELECT COUNT(*) AS cnt FROM students WHERE instructor_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result()->fetch_assoc();

if ($res['cnt'] > 0) {
    $_SESSION['error'] = "Cannot delete instructor: some students are assigned.";
} else {
    $stmt = $conn->prepare("DELETE FROM instructors WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $_SESSION['success'] = "Instructor deleted successfully.";
}

header("Location: instructors.php");
exit;