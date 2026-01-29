<?php
require_once "../includes/functions.php";

if (isset($_GET['id'])) {
    deleteStudent($_GET['id']);
}

header("Location: index.php");
exit;
