<?php
require_once "../config/auth.php";
require_once "../config/db.php";

$success = $error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("UPDATE students SET name=?, course=? WHERE id=?");
    $stmt->bind_param("ssi", $_POST['name'], $_POST['course'], $_POST['id']);

    if ($stmt->execute()) {
        $success = "Student updated successfully!";
    } else {
        $error = "Error: " . $stmt->error;
    }
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<div class="login-box">
    <h2>Update Student</h2>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>
    <?php if ($success) echo "<p class='success'>$success</p>"; ?>
    <form method="POST">
        <input type="number" name="id" placeholder="Student ID" required>
        <input type="text" name="name" placeholder="New Name" required>
        <input type="text" name="course" placeholder="New Course" required>
        <button type="submit">Update</button>
    </form>
</div>
