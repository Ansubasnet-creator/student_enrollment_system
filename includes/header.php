<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollment System</title>

    <!-- LINK YOUR CSS -->
    <link rel="stylesheet" href="../assets/css/style.css?v=<?= time() ?>">

    <!-- Optional JS for search/filter -->
    <script src="../assets/js/search.js" defer></script>
</head>
<body>

<!-- Topbar -->
<div class="topbar" style="padding:15px; background:#52b788; color:#fff; font-weight:bold; font-size:18px; text-align:center;">
    Student Enrollment System
</div>

<!-- Navbar for logged-in admin -->
<?php if (!empty($_SESSION['admin_id'])): ?>
    <div class="navbar" style="display:flex; gap:20px; padding:10px 20px; background:#f4f6f8; font-weight:bold;">
        <a href="dashboard.php" style="text-decoration:none; color:#1b4332;">Dashboard</a>
        <a href="students.php" style="text-decoration:none; color:#1b4332;">Students</a>
        <a href="courses.php" style="text-decoration:none; color:#1b4332;">Courses</a>
        <a href="instructors.php" style="text-decoration:none; color:#1b4332;">Instructors</a>
        <a href="logout.php" style="text-decoration:none; color:#d00000;">Logout</a>
    </div>
<?php endif; ?>

<!-- Main container for page content -->
<div class="container" style="padding:30px;">
