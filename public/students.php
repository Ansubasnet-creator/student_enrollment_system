<?php
require_once "../config/db.php";
require_once "../config/auth.php";

$result = mysqli_query($con, "SELECT * FROM students");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Student List</h2>
    <a href="add.php">Add Student</a> | <a href="logout.php">Logout</a>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this student?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>