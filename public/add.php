<?php
require_once "../config/db.php";
require_once "../config/auth.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    $stmt = mysqli_prepare($con, "INSERT INTO students (name, email) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
    mysqli_stmt_execute($stmt);

    header("Location: students.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Add Student</h2>
    <form method="post">
        <label>Name:</label><br>
        <input type="text" name="name" required><br>
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        <button type="submit">Add</button>
    </form>
</body>
</html>