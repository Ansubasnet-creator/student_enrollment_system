<?php
require_once "../config/auth.php";
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

$result = $conn->query("SELECT * FROM instructors");
?>
<div class="container">
    <h2>Instructors</h2>

    <div class="search-bar">
        <input type="text" id="instructorSearch" placeholder="Search instructors...">
        <a class="btn-add" href="add_instructor.php">Add Instructor</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Expertise</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="instructorTable">
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= e($row['full_name']) ?></td>
                <td><?= e($row['email']) ?></td>
                <td><?= e($row['expertise']) ?></td>
                <td>
                    <a href="edit_instructor.php?id=<?= $row['id'] ?>">Edit</a> |
                    <a href="delete_instructor.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete instructor?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<link rel="stylesheet" href="../assets/css/style.css">
<script src="../assets/js/search.js" defer></script>
<?php include "../includes/footer.php"; ?>
