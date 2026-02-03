<?php
require_once "../config/auth.php";
require_once "../config/db.php";

$id = (int)$_GET['id'];

// Check if any students are linked to this course
$stmt = $conn->prepare("SELECT COUNT(*) AS cnt FROM students WHERE course_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result()->fetch_assoc();

if ($res['cnt'] > 0) {
    $_SESSION['error'] = "Cannot delete course: students are enrolled.";
} else {
    $stmt = $conn->prepare("DELETE FROM courses WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $_SESSION['success'] = "Course deleted successfully.";
}

header("Location: courses.php");
exit;