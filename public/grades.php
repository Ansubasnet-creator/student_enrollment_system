<?php
require_once "../config/auth.php";
require_once "../config/db.php";
include "../includes/header.php";

$sql = "
SELECT g.id, s.name, g.subject, g.grade
FROM grades g
JOIN students s ON g.student_id = s.id
ORDER BY s.name
";
$result = $conn->query($sql);
?>

<h2>Grades</h2>
<a href="add_grade.php">+ Add Grade</a>

<table>
<tr>
    <th>Student</th>
    <th>Subject</th>
    <th>Grade</th>
    <th>Action</th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td><?= htmlspecialchars($row['subject']) ?></td>
    <td><?= htmlspecialchars($row['grade']) ?></td>
    <td>
        <a href="edit_grade.php?id=<?= $row['id'] ?>">Edit</a> |
        <a href="delete_grade.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete?')">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<?php include "../includes/footer.php"; ?>
