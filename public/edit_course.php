<?php
require_once "../config/auth.php";
require_once "../config/db.php";
include "../includes/header.php";

/* ===============================
   1. Validate ID
================================ */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid course ID");
}

$id = (int) $_GET['id'];

/* ===============================
   2. Fetch course safely
================================ */
$stmt = $conn->prepare("SELECT * FROM courses WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Course not found");
}

$course = $result->fetch_assoc();

/* ===============================
   3. Fetch instructors for dropdown (optional)
================================ */
$instructors = $conn->query("SELECT id, full_name FROM instructors");

/* ===============================
   4. Handle update
================================ */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $course_name   = trim($_POST['course_name']);
    $instructor_id = (int) $_POST['instructor_id'];

    if (!$course_name) {
        $error = "Course name is required.";
    } else {
        $update = $conn->prepare(
            "UPDATE courses SET course_name=?, instructor_id=? WHERE id=?"
        );
        $update->bind_param("sii", $course_name, $instructor_id, $id);
        $update->execute();

        header("Location: courses.php");
        exit;
    }
}
?>

<h2>Edit Course</h2>

<?php if (!empty($error)): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post" class="edit-course">
    <input type="text" name="course_name"
           value="<?= htmlspecialchars($course['course_name']) ?>" 
           placeholder="Course Name" required>

    <select name="instructor_id" required>
        <?php while ($ins = $instructors->fetch_assoc()): ?>
            <option value="<?= $ins['id']; ?>"
                <?= ($ins['id'] == $course['instructor_id']) ? 'selected' : ''; ?>>
                <?= htmlspecialchars($ins['full_name']); ?>
            </option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Update Course</button>
</form>

<?php include "../includes/footer.php"; ?>
