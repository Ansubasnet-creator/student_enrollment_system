<?php
require "../config/db.php";
require "../includes/functions.php";
include "../includes/header.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM student_enrollment WHERE id=?");
$stmt->execute([$id]);
$student = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare(
        "UPDATE student_enrollment SET name=?, email=?, course=?, year=? WHERE id=?"
    );
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['course'],
        $_POST['year'],
        $id
    ]);
    header("Location: index.php");
}
?>

<form method="POST">
    Name: <input name="name" value="<?= e($student['name']) ?>"><br>
    Email: <input name="email" value="<?= e($student['email']) ?>"><br>
    Course: <input name="course" value="<?= e($student['course']) ?>"><br>
    Year: <input name="year" value="<?= e($student['year']) ?>"><br>
    <button>Update Student</button>
</form>

<?php include "../includes/footer.php"; ?>
