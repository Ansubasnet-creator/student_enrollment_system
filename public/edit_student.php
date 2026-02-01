<?php
require_once "../config/auth.php";
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

$error = "";
$id = $_GET['id'] ?? 0;

// Fetch student
$student = $conn->query("SELECT * FROM students WHERE id=$id")->fetch_assoc();
if (!$student) {
    echo "<div class='error'>Student not found.</div>";
    include "../includes/footer.php";
    exit;
}

// Fetch courses and instructors
$courses = $conn->query("SELECT id, course_name FROM courses ORDER BY course_name");
$instructors = $conn->query("SELECT id, full_name FROM instructors ORDER BY full_name");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $course_id = $_POST['course_id'];
    $instructor_id = $_POST['instructor_id'];

    // Validation
    if (!$name || !preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $error = "Please enter a valid name (letters only).";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email.";
    } elseif (!$course_id) {
        $error = "Please select a course.";
    } elseif (!$instructor_id) {
        $error = "Please select an instructor.";
    } else {
        $stmt = $conn->prepare(
            "UPDATE students SET name=?, email=?, course_id=?, instructor_id=? WHERE id=?"
        );
        $stmt->bind_param("ssiii", $name, $email, $course_id, $instructor_id, $id);
        $stmt->execute();
        header("Location: students.php");
        exit;
    }
}
?>

<h2>Edit Student</h2>

<?php if ($error): ?>
    <div class="error"><?= e($error) ?></div>
<?php endif; ?>

<form method="post">
    <input type="text" name="name" value="<?= e($_POST['name'] ?? $student['name']) ?>" required>
    <input type="email" name="email" value="<?= e($_POST['email'] ?? $student['email']) ?>" required>

    <select name="course_id" required>
        <option value="">-- Select Course --</option>
        <?php while($c = $courses->fetch_assoc()): ?>
            <option value="<?= $c['id'] ?>" <?= (($student['course_id'] ?? '') == $c['id']) ? 'selected' : '' ?>>
                <?= e($c['course_name']) ?>
            </option>
        <?php endwhile; ?>
    </select>

    <select name="instructor_id" required>
        <option value="">-- Select Instructor --</option>
        <?php while($i = $instructors->fetch_assoc()): ?>
            <option value="<?= $i['id'] ?>" <?= (($student['instructor_id'] ?? '') == $i['id']) ? 'selected' : '' ?>>
                <?= e($i['full_name']) ?>
            </option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Update Student</button>
</form>

<?php include "../includes/footer.php"; ?>
