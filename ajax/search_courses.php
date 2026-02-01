<?php
require_once "../config/db.php";
require_once "../config/auth.php";

$q = "%" . ($_GET['q'] ?? "") . "%";

$stmt = $conn->prepare("
    SELECT courses.*, instructors.full_name
    FROM courses
    LEFT JOIN instructors ON courses.instructor_id = instructors.id
    WHERE courses.course_name LIKE ? OR courses.level LIKE ? OR instructors.full_name LIKE ?
");
$stmt->bind_param("sss", $q, $q, $q);
$stmt->execute();
$res = $stmt->get_result();

while ($r = $res->fetch_assoc()) {
    echo "<tr>
        <td>".htmlspecialchars($r['course_name'])."</td>
        <td>".htmlspecialchars($r['level'])."</td>
        <td>".htmlspecialchars($r['full_name'] ?? 'Unassigned')."</td>
        <td>
            <a href='edit_course.php?id={$r['id']}'>Edit</a> |
            <a href='delete_course.php?id={$r['id']}' onclick='return confirm(\"Delete course?\")'>Delete</a>
        </td>
    </tr>";
}
