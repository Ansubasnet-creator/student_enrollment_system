<?php
require_once "../config/auth.php";
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

$result = $conn->query("
    SELECT students.*, courses.course_name, instructors.full_name AS instructor_name
    FROM students
    LEFT JOIN courses ON students.course_id = courses.id
    LEFT JOIN instructors ON students.instructor_id = instructors.id
");
?>
<div class="container">
    <h2>Students</h2>

    <div class="search-bar">
        <input type="text" id="studentSearch" placeholder="Search students...">
        <a class="btn-add" href="add_student.php">Add Student</a>
    </div>

    <table>
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
        <tbody id="studentTable">
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= e($row['name']) ?></td>
                <td><?= e($row['email']) ?></td>
                <td><?= e($row['course_name'] ?? 'N/A') ?></td>
                <td><?= e($row['instructor_name'] ?? 'N/A') ?></td>
                <td><?= e($row['created_at']) ?></td>
                <td>
                    <a href="edit_student.php?id=<?= $row['id'] ?>">Edit</a> |
                    <a href="delete_student.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete student?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<link rel="stylesheet" href="../assets/css/style.css">
<script src="../assets/js/search.js" defer></script>
<?php include "../includes/footer.php"; ?>
