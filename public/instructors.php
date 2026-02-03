<?php
require_once "../config/auth.php";
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

// Fetch instructors
$sql = "SELECT id, full_name, email, created_at FROM instructors ORDER BY full_name";
$result = $conn->query($sql);
?>

<h2>Instructors</h2>

<a href="add_instructor.php" class="btn btn-primary">Add Instructor</a>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= e($row['full_name']) ?></td>
                <td><?= e($row['email']) ?></td>
                <td><?= e($row['created_at']) ?></td>
                <td>
                    <a href="edit_instructor.php?id=<?= $row['id'] ?>">Edit</a> |
                    <a href="delete_instructor.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this instructor?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include "../includes/footer.php"; ?>