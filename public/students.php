<?php
require_once "../config/auth.php";
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

// Fetch students with instructor name
$sql = "SELECT s.id, s.name, s.email, s.course, i.full_name AS instructor, s.created_at
        FROM students s
        LEFT JOIN instructors i ON s.instructor_id = i.id
        ORDER BY s.name";
$result = $conn->query($sql);
?>

<h2>Students</h2>

<a href="add_student.php" class="btn btn-primary">Add Student</a>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Course</th>
            <th>Instructor</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= e($row['name']) ?></td>
                <td><?= e($row['email']) ?></td>
                <td><?= e($row['course']) ?></td>
                <td><?= e($row['instructor'] ?? 'N/A') ?></td>
                <td><?= e($row['created_at']) ?></td>
                <td>
                    <a href="edit_student.php?id=<?= $row['id'] ?>">Edit</a> |
                    <a href="delete_student.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this student?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include "../includes/footer.php"; ?>