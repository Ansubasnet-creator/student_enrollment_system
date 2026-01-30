<?php
session_start();
include __DIR__ . '/../db.php';
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $course = $_POST['course'];

    $stmt = $conn->prepare("UPDATE students SET name=?, course=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $course, $id);

    if ($stmt->execute()) {
        echo "Student updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Enrollment - Update Student</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
<div class="box">
    <h2>Update Student</h2>
    <form method="POST">
        <input type="number" name="id" placeholder="Student ID" required><br>
        <input type="text" name="name" placeholder="New Name" required><br>
        <input type="text" name="course" placeholder="New Course" required><br>
        <button type="submit">Update</button>
    </form>
</div>
</body>
</html>