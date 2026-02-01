<?php
require_once "../config/auth.php";
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

$id = $_GET['id'] ?? 0;
$course = $conn->query("SELECT * FROM courses WHERE id=$id")->fetch_assoc();
if (!$course) { echo "<div class='error'>Course not found.</div>"; include "../includes/footer.php"; exit; }

$error = "";
$instructors = $conn->query("SELECT id, full_name FROM instructors ORDER BY full_name");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $course_code = trim($_POST['course_code']);
    $course_name = trim($_POST['course_name']);
    $category = trim($_POST['category']);
    $level = trim($_POST['level']);
    $instructor_id = $_POST['instructor_id'];

    if (!$course_code || !$course_name || !$category || !$level) {
        $error = "All fields are required.";
    } else {
        $stmt = $conn->prepare(
            "UPDATE courses SET course_code=?, course_name=?, category=?, level=?, instructor_id=? WHERE id=?"
        );
        $stmt->bind_param("ssssii", $course_code, $course_name, $category, $level, $instructor_id, $id);
        $stmt->execute();
        header("Location: courses.php");
        exit;
    }
}
?>

<h2>Edit Course</h2>
<?php if ($error): ?><div class="error"><?= e($error) ?></div><?php endif; ?>

<form method="post">
    <input type="text" name="course_code" value="<?= e($_POST['course_code'] ?? $course['course_code']) ?>" required>
    <input type="text" name="course_name" value="<?= e($_POST['course_name'] ?? $course['course_name']) ?>" required>
    <input type="text" name="category" value="<?= e($_POST['category'] ?? $course['category']) ?>" required>
    <input type="text" name="level" value="<?= e($_POST['level'] ?? $course['level']) ?>" required>

    <select name="instructor_id" required>
        <option value="">-- Select Instructor --</option>
        <?php while($i = $instructors->fetch_assoc()): ?>
            <option value="<?= $i['id'] ?>" <?= (($course['instructor_id'] ?? '') == $i['id']) ? 'selected' : '' ?>>
                <?= e($i['full_name']) ?>
            </option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Update Course</button>
</form>

<?php include "../includes/footer.php"; ?>
