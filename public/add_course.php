<?php
require_once "../config/auth.php";
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

$error = "";
$instructors = $conn->query("SELECT id, full_name FROM instructors ORDER BY full_name");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $course_code = trim($_POST['course_code']);
    $course_name = trim($_POST['course_name']);
    $category = trim($_POST['category']);
    $level = trim($_POST['level']);
    $instructor_id = $_POST['instructor_id'];

    if (!$course_code) {
        $error = "Course code is required.";
    } elseif (!$course_name) {
        $error = "Course name is required.";
    } elseif (!$category) {
        $error = "Category is required.";
    } elseif (!$level) {
        $error = "Level is required.";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO courses (course_code, course_name, category, level, instructor_id) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssssi", $course_code, $course_name, $category, $level, $instructor_id);
        $stmt->execute();
        header("Location: courses.php");
        exit;
    }
}
?>

<h2>Add Course</h2>

<?php if ($error): ?>
    <div class="error"><?= e($error) ?></div>
<?php endif; ?>

<form method="post" class="form-standard">
    <input type="text" name="course_code" placeholder="Course Code" value="<?= e($_POST['course_code'] ?? '') ?>" required>
    <input type="text" name="course_name" placeholder="Course Name" value="<?= e($_POST['course_name'] ?? '') ?>" required>
    <input type="text" name="category" placeholder="Category" value="<?= e($_POST['category'] ?? '') ?>" required>

    <!-- Dropdown for ENUM level -->
    <select name="level" required>
        <option value="">-- Select Level --</option>
        <option value="Beginner" <?= (($_POST['level'] ?? '') == 'Beginner') ? 'selected' : '' ?>>Beginner</option>
        <option value="Intermediate" <?= (($_POST['level'] ?? '') == 'Intermediate') ? 'selected' : '' ?>>Intermediate</option>
        <option value="Advanced" <?= (($_POST['level'] ?? '') == 'Advanced') ? 'selected' : '' ?>>Advanced</option>
    </select>

    <select name="instructor_id" required>
        <option value="">-- Select Instructor --</option>
        <?php while($i = $instructors->fetch_assoc()): ?>
            <option value="<?= $i['id'] ?>" <?= (($_POST['instructor_id'] ?? '') == $i['id']) ? 'selected' : '' ?>>
                <?= e($i['full_name']) ?>
            </option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Add Course</button>
</form>

<?php include "../includes/footer.php"; ?>