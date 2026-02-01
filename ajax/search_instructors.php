<?php
require_once "../config/db.php";
require_once "../config/auth.php";

$q = "%" . ($_GET['q'] ?? "") . "%";

$stmt = $conn->prepare("
    SELECT * FROM instructors
    WHERE full_name LIKE ? OR email LIKE ? OR expertise LIKE ?
");
$stmt->bind_param("sss", $q, $q, $q);
$stmt->execute();
$res = $stmt->get_result();

while ($r = $res->fetch_assoc()) {
    echo "<tr>
        <td>".htmlspecialchars($r['full_name'])."</td>
        <td>".htmlspecialchars($r['email'])."</td>
        <td>".htmlspecialchars($r['expertise'])."</td>
        <td>
            <a href='edit_instructor.php?id={$r['id']}'>Edit</a> |
            <a href='delete_instructor.php?id={$r['id']}' onclick='return confirm(\"Delete instructor?\")'>Delete</a>
        </td>
    </tr>";
}
