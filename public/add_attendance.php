<?php
require_once "../config/auth.php";
require_once "../config/db.php";
include "../includes/header.php";

$students = $conn->query("SELECT id, name FROM students");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_POST['student_id'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    if ($student_id && $date && $status) {
        $stmt = $conn->prepare(
            "INSERT INTO attendance (student_id, date, status) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("iss", $student_id, $date, $status);
        $stmt->execute();
        header("Location: attendences.php");
        exit;
    }
}
?>

<h2>Add Attendance</h2>

<form method="post">
    <select name="student_id" required>
        <option value="">Select Student</option>
        <?php while ($s = $students->fetch_assoc()): ?>
            <option value="<?= $s['id'] ?>"><?= $s['name'] ?></option>
        <?php endwhile; ?>
    </select>

    <input type="date" name="date" required>

    <select name="status" required>
        <option value="Present">Present</option>
        <option value="Absent">Absent</option>
    </select>

    <button type="submit">Save</button>
</form>

<?php include "../includes/footer.php"; ?>
