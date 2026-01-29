<?php
require_once '../includes/functions.php';

$id = $_GET['id'];
$student = getStudentById($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    updateStudent($id, $_POST['name'], $_POST['email'], $_POST['course'], $_POST['year']);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
<link rel="stylesheet" href="/student_enrollment_system/assets/css/style.css">

</head>
<body>

<h1>Edit Student</h1>

<form method="post">
    <input name="name" value="<?= $student['name'] ?>" required>
    <input name="email" value="<?= $student['email'] ?>" required>
    <input name="course" value="<?= $student['course'] ?>" required>
    <input name="year" value="<?= $student['year'] ?>" required>
    <button>Update</button>
</form>

<a href="index.php">⬅ Back</a>

</body>
</html>
