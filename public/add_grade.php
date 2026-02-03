<?php
require_once "../config/auth.php";
require_once "../config/db.php";
include "../includes/header.php";

$students = $conn->query("SELECT id, name FROM students");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_POST['student_id'];
    $subject = trim($_POST['subject']);
    $grade = trim($_POST['grade']);

    if ($student_id && $subject && $grade) {
        $stmt = $conn->prepare(
            "INSERT INTO grades (student_id, subject, grade) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("iss", $student_id, $subject, $grade);
        $stmt->execute();
        header("Location: grades.php");
        exit;
    } else {
        $error = "All fields required";
    }
}
?>

<h2>Add Grade</h2>
<?php if (!empty($error)) echo "<p>$error</p>"; ?>

<form method="post">
    <select name="student_id" required>
        <option value="">Select Student</option>
        <?php while ($s = $students->fetch_assoc()): ?>
            <option value="<?= $s['id'] ?>"><?= $s['name'] ?></option>
        <?php endwhile; ?>
    </select>
    <input type="text" name="subject" placeholder="Subject" required>
    <input type="text" name="grade" placeholder="Grade" required>
    <button type="submit">Save</button>
</form>

<?php include "../includes/footer.php"; ?>