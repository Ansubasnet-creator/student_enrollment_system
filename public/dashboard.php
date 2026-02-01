<?php
require_once "../config/auth.php";
require_once "../includes/functions.php";
include "../includes/header.php";
?>

<h2>Welcome, <?= e($_SESSION['admin_username']) ?></h2>

<div class="dashboard">
    <div class="cards">
        <a class="card" href="students.php">Manage Students</a>
        <a class="card" href="courses.php">Manage Courses</a>
        <a class="card" href="instructors.php">Manage Instructors</a>
        <a class="card logout" href="logout.php">Logout</a>
    </div>
</div>

<?php include "../includes/footer.php"; ?>
