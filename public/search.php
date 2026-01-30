<?php
include "../config/db.php";

$term = $_GET['term'];
$result = $conn->query(
    "SELECT name FROM students WHERE name LIKE '%$term%'"
);

while ($row = $result->fetch_assoc()) {
    echo "<div>".$row['name']."</div>";
}
