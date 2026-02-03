<?php
require_once "../config/auth.php";
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

$error = "";
$success = "";

// Fetch courses and instructors
$courses = $conn->query("SELECT id, course_name, category FROM courses ORDER BY course_name");
$instructors = $conn->query("SELECT id, full_name, expertise FROM instructors ORDER BY full_name");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $course_id = $_POST['course_id'] ?? 0;
    $instructor_id = $_POST['instructor_id'] ?? 0;

    if (!$course_id) {
        $error = "Please select a course.";
    } elseif (!$instructor_id) {
        $error = "Please select an instructor.";
    } else {
        $stmt = $conn->prepare("UPDATE courses SET instructor_id=? WHERE id=?");
        $stmt->bind_param("ii", $instructor_id, $course_id);
        $stmt->execute();
        $success = "Instructor assigned successfully!";
    }
}
?>

<h2>Assign Instructor to Course</h2>

<?php if ($error): ?>
    <div class="error"><?= e($error) ?></div>
<?php endif; ?>

<?php if ($success): ?>
    <div class="success"><?= e($success) ?></div>
<?php endif; ?>

<form method="post" id="assignForm">
    <select name="course_id" id="courseSelect" required>
        <option value="">-- Select Course --</option>
        <?php while($c = $courses->fetch_assoc()): ?>
            <option value="<?= $c['id'] ?>">
                <?= e($c['course_name']) ?> (<?= e($c['category']) ?>)
            </option>
        <?php endwhile; ?>
    </select>

    <select name="instructor_id" id="instructorSelect" required>
        <option value="">-- Select Instructor --</option>
        <?php while($i = $instructors->fetch_assoc()): ?>
            <option value="<?= $i['id'] ?>">
                <?= e($i['full_name']) ?> (<?= e($i['expertise']) ?>)
            </option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Assign Instructor</button>
</form>

<script>
    // Optional: filter instructors by expertise matching course category
    const courseSelect = document.getElementById('courseSelect');
    const instructorSelect = document.getElementById('instructorSelect');

    courseSelect.addEventListener('change', () => {
        const selectedCourse = courseSelect.options[courseSelect.selectedIndex].text;
        const categoryMatch = selectedCourse.match(/\((.*?)\)$/); // get category in parentheses
        if (!categoryMatch) return;

        const category = categoryMatch[1].toLowerCase();

        for (let i = 0; i < instructorSelect.options.length; i++) {
            const option = instructorSelect.options[i];
            if (i === 0) continue; // skip placeholder
            const expertise = option.text.match(/\((.*?)\)$/)[1].toLowerCase();
            option.style.display = expertise.includes(category) ? '' : 'none';
        }
        instructorSelect.value = '';
    });
</script>

<?php include "../includes/footer.php"; ?>