<?php
require_once "../config/auth.php";
require_once "../config/db.php";

$result = $conn->query("SELECT * FROM students");
?>

<link rel="stylesheet" href="../assets/css/style.css">

<div class="dashboard-box">
    <h2>Student List</h2>
    <div class="dashboard-links">
        <a href="add.php">Add Student</a> | <a href="logout.php">Logout</a>
    </div>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['course']) ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this student?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
