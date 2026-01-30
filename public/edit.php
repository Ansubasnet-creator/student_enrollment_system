<?php
require_once "../config/db.php";
require_once "../config/auth.php";

$id = intval($_GET['id']);
$result = mysqli_query($con, "SELECT * FROM students WHERE id = $id");
$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    $stmt = mysqli_prepare($con, "UPDATE students SET name = ?, email = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ssi", $name, $email, $id);
    mysqli_stmt_execute($stmt);

    header("Location: students.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Edit Student</h2>
    <form method="post">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required><br>
        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>