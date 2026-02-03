<?php
require_once "../config/auth.php";
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

// Fetch courses with instructor name
$sql = "SELECT c.id, c.course_code, c.course_name, c.category, c.level, i.full_name AS instructor
        FROM courses c
        LEFT JOIN instructors i ON c.instructor_id = i.id
        ORDER BY c.course_name";
$result = $conn->query($sql);
?>

<h2>Courses</h2>

<a href="add_course.php" class="btn btn-primary">Add Course</a>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Course Code</th>
            <th>Name</th>
            <th>Category</th>
            <th>Level</th> <!-- make sure this header exists -->
            <th>Instructor</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= e($row['course_code']) ?></td>
                <td><?= e($row['course_name']) ?></td>
                <td><?= e($row['category']) ?></td>
                <td><?= e($row['level']) ?></td> <!-- THIS LINE DISPLAYS LEVEL -->
                <td><?= e($row['instructor'] ?? 'N/A') ?></td>
                <td>
                    <a href="edit_course.php?id=<?= $row['id'] ?>">Edit</a> |
                    <a href="delete_course.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this course?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include "../includes/footer.php"; ?>