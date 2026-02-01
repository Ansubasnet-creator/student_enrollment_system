<?php
require_once "../config/auth.php";
require_once "../config/db.php";
include "../includes/header.php";

$result = $conn->query("
    SELECT courses.*, instructors.full_name
    FROM courses
    LEFT JOIN instructors ON courses.instructor_id = instructors.id
");
?>

<h2>Courses</h2>
<input type="text" id="search" placeholder="Search courses...">
<a class="btn" href="add_course.php">Add Course</a>

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
            <td><?= htmlspecialchars($row['course_name']) ?></td>
            <td><?= htmlspecialchars($row['level']) ?></td>
            <td><?= htmlspecialchars($row['full_name'] ?? 'Unassigned') ?></td>
            <td>
                <a href="edit_course.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="delete_course.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete course?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include "../includes/footer.php"; ?>
