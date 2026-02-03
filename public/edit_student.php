<?php
require_once "../config/auth.php";
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

/* ===============================
   Validate ID
================================ */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid student ID");
}

$id = (int) $_GET['id'];

/* ===============================
   Fetch student
================================ */
$stmt = $conn->prepare("SELECT * FROM students WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();

if (!$student) {
    die("Student not found");
}

/* ===============================
   Handle update
================================ */
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);

    if (!$name) {
        $error = "Name is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Enter a valid email.";
    } else {
        $update = $conn->prepare(
            "UPDATE students SET name=?, email=? WHERE id=?"
        );
        $update->bind_param("ssi", $name, $email, $id);
        $update->execute();

        header("Location: students.php");
        exit;
    }
}
?>

<h2>Edit Student</h2>

<?php if ($error): ?>
    <div class="error"><?= e($error) ?></div>
<?php endif; ?>

<form method="post" class="edit-student">
    <input type="text"
           name="name"
           value="<?= e($student['name']) ?>"
           required>

    <input type="email"
           name="email"
           value="<?= e($student['email']) ?>"
           required>

    <button type="submit">Update Student</button>
</form>

<?php include "../includes/footer.php"; ?>
