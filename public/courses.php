<?php
require_once "../config/auth.php";
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

$result = $conn->query("
    SELECT courses.*, instructors.full_name 
    FROM courses 
    LEFT JOIN instructors ON courses.instructor_id = instructors.id
");
?>
<div class="container">
    <h2>Courses</h2>

    <div class="search-bar">
        <input type="text" id="courseSearch" placeholder="Search courses...">
        <a class="btn-add" href="add_course.php">Add Course</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Level</th>
                <th>Instructor</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="courseTable">
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= e($row['course_name']) ?></td>
                <td><?= e($row['level']) ?></td>
                <td><?= e($row['full_name'] ?? 'Unassigned') ?></td>
                <td>
                    <a href="edit_course.php?id=<?= $row['id'] ?>">Edit</a> |
                    <a href="delete_course.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete course?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<link rel="stylesheet" href="../assets/css/style.css">
<script src="../assets/js/search.js" defer></script>
<?php include "../includes/footer.php"; ?>
