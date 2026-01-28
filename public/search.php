<?php
require "../config/db.php";

$q = "%" . $_GET['q'] . "%";

$stmt = $pdo->prepare(
    "SELECT * FROM student_enrollment WHERE name LIKE ? OR course LIKE ?"
);
$stmt->execute([$q, $q]);

foreach ($stmt as $row) {
    echo "<p>{$row['name']} - {$row['course']}</p>";
}
