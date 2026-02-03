<?php
require_once "../config/auth.php";
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

$error = "";
$courses = $conn->query("SELECT id, course_name FROM courses ORDER BY course_name");
$instructors = $conn->query("SELECT id, full_name FROM instructors ORDER BY full_name");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $course_id = $_POST['course_id'];
    $instructor_id = $_POST['instructor_id'];

    if (!$name) {
        $error = "Name is required.";
    } elseif (!$email) {
        $error = "Email is required.";
    } elseif (!$course_id) {
        $error = "Course is required.";
    } elseif (!$instructor_id) {
        $error = "Instructor is required.";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO students (name, email, course, instructor_id) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("sssi", $name, $email, $course_id, $instructor_id);
        $stmt->execute();
        header("Location: students.php");
        exit;
    }
}
?>

<h2>Add Student</h2>

<?php if ($error): ?>
    <div class="error"><?= e($error) ?></div>
<?php endif; ?>

<form method="post" class="form-standard">
    <input type="text" name="name" placeholder="Full Name" value="<?= e($_POST['name'] ?? '') ?>" required>
    <input type="email" name="email" placeholder="Email" value="<?= e($_POST['email'] ?? '') ?>" required>

    <!-- Dropdown for courses -->
    <select name="course_id" required>
        <option value="">-- Select Course --</option>
        <?php while($c = $courses->fetch_assoc()): ?>
            <option value="<?= $c['course_name'] ?>" <?= (($_POST['course_id'] ?? '') == $c['course_name']) ? 'selected' : '' ?>>
                <?= e($c['course_name']) ?>
            </option>
        <?php endwhile; ?>
    </select>

    <!-- Dropdown for instructors -->
    <select name="instructor_id" required>
        <option value="">-- Select Instructor --</option>
        <?php while($i = $instructors->fetch_assoc()): ?>
            <option value="<?= $i['id'] ?>" <?= (($_POST['instructor_id'] ?? '') == $i['id']) ? 'selected' : '' ?>>
                <?= e($i['full_name']) ?>
            </option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Add Student</button>
</form>

<?php include "../includes/footer.php"; ?>