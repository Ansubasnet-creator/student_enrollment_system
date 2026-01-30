<?php
require "../config/db.php";
require "../includes/functions.php";
include "../includes/header.php";

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    if (!verify_csrf_token($_POST['csrf_token'])) die("Invalid CSRF token");
    $stmt=$pdo->prepare("INSERT INTO grades (student_id,subject,grade) VALUES (?,?,?)");
    $stmt->execute([$_POST['student_id'],$_POST['subject'],$_POST['grade']]);
}
$students=$pdo->query("SELECT * FROM student_enrollment")->fetchAll();
?>
<h2>Grades</h2>
<form method="POST">
    <input type="hidden" name="csrf_token" value="<?= generate_csrf_token() ?>">
    <label>Student:</label>
    <select name="student_id">
        <?php foreach($students as $s): ?>
        <option value="<?= $s['id'] ?>"><?= e($s['name']) ?></option>
        <?php endforeach; ?>
    </select>
    <label>Subject:</label><input name="subject" required>
    <label>Grade:</label><input name="grade" required>
    <button>Add Grade</button>
</form>
<?php include "../includes/footer.php"; ?>