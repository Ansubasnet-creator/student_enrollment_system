<?php
require_once "../config/db.php";
require_once "../config/auth.php";

$q = "%" . ($_GET['q'] ?? "") . "%";

$stmt = $conn->prepare("
    SELECT students.*, courses.course_name, instructors.full_name AS instructor_name
    FROM students
    LEFT JOIN courses ON students.course_id = courses.id
    LEFT JOIN instructors ON students.instructor_id = instructors.id
    WHERE students.name LIKE ? OR students.email LIKE ? OR courses.course_name LIKE ? OR instructors.full_name LIKE ?
");
$stmt->bind_param("ssss", $q, $q, $q, $q);
$stmt->execute();
$res = $stmt->get_result();

while ($r = $res->fetch_assoc()) {
    echo "<tr>
        <td>".htmlspecialchars($r['name'])."</td>
        <td>".htmlspecialchars($r['email'])."</td>
        <td>".htmlspecialchars($r['course_name'] ?? 'N/A')."</td>
        <td>".htmlspecialchars($r['instructor_name'] ?? 'N/A')."</td>
        <td>".htmlspecialchars($r['created_at'])."</td>
        <td>
            <a href='edit_student.php?id={$r['id']}'>Edit</a> |
            <a href='delete_student.php?id={$r['id']}' onclick='return confirm(\"Delete student?\")'>Delete</a>
        </td>
    </tr>";
}
