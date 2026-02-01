<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Enrollment System</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/search.js" defer></script>
</head>
<body>
<div class="topbar">Student Enrollment System</div>

<?php if (!empty($_SESSION['admin_id'])): ?>
    <?php include __DIR__ . "/navbar.php"; ?>
<?php endif; ?>

<div class="container">
