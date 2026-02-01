<?php
require_once "../config/auth.php";
require_once "../config/db.php";

$term = isset($_GET['term']) ? $_GET['term'] : '';
$stmt = $conn->prepare("SELECT name FROM students WHERE name LIKE ?");
$like = "%$term%";
$stmt->bind_param("s", $like);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<div>".htmlspecialchars($row['name'])."</div>";
}
?>
