<?php
require "../config/db.php";
require "../includes/functions.php";
include "../includes/header.php";

$stmt = $pdo->query("SELECT * FROM student_enrollment");
$students = $stmt->fetchAll();
?>

<a href="add.php">Add Student</a><br><br>

<input type="text" id="search" placeholder="Search students by name or course">
<div id="result"></div>

<table border="1" width="100%">
<tr>
    <th>Name</th>
    <th>Email</th>
    <th>Course</th>
    <th>Year</th>
    <th>Action</th>
</tr>

<?php foreach ($students as $s): ?>
<tr>
    <td><?= e($s['name']) ?></td>
    <td><?= e($s['email']) ?></td>
    <td><?= e($s['course']) ?></td>
    <td><?= e($s['year']) ?></td>
    <td>
        <a href="edit.php?id=<?= $s['id'] ?>">Edit</a> |
        <a href="delete.php?id=<?= $s['id'] ?>" onclick="return confirm('Delete?')">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<?php include "../includes/footer.php"; ?>
