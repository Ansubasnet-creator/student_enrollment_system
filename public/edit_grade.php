<?php
require_once "../config/auth.php";
require_once "../config/db.php";
include "../includes/header.php";

$id = $_GET['id'];

$grade = $conn->query("SELECT * FROM grades WHERE id=$id")->fetch_assoc();
$students = $conn->query("SELECT id, name FROM students");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_POST['student_id'];
    $subject = $_POST['subject'];
    $gradeVal = $_POST['grade'];

    $stmt = $conn->prepare(
        "UPDATE grades SET student_id=?, subject=?, grade=? WHERE id=?"
    );
    $stmt->bind_param("issi", $student_id, $subject, $gradeVal, $id);
    $stmt->execute();
    header("Location: grades.php");
    exit;
}
?>

<h2>Edit Grade</h2>

<form method="post">
    <select name="student_id" required>
        <?php while ($s = $students->fetch_assoc()): ?>
            <option value="<?= $s['id'] ?>" <?= $s['id']==$grade['student_id']?'selected':'' ?>>
                <?= $s['name'] ?>
            </option>
        <?php endwhile; ?>
    </select>
    <input type="text" name="subject" value="<?= $grade['subject'] ?>" required>
    <input type="text" name="grade" value="<?= $grade['grade'] ?>" required>
    <button type="submit">Update</button>
</form>

<?php include "../includes/footer.php"; ?>
