<?php
require_once "../config/auth.php";
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php"; 
?>
<link rel="stylesheet" href="../assets/css/style.css?v=<?= time() ?>">
<div class="search-add-section">
    <form class="search-form">
        <input type="text" id="courseSearch" placeholder="Search courses...">
        <button type="button">Search</button>
    </form>

    <a class="btn-add" href="add_course.php">Add Course</a>
</div>
