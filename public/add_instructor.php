<?php
require_once "../config/auth.php";
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);

    if (!$full_name) {
        $error = "Full name is required.";
    } elseif (!$email) {
        $error = "Email is required.";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO instructors (full_name, email) VALUES (?, ?)"
        );
        $stmt->bind_param("ss", $full_name, $email);
        $stmt->execute();
        header("Location: instructors.php");
        exit;
    }
}
?>

<h2>Add Instructor</h2>

<?php if ($error): ?>
    <div class="error"><?= e($error) ?></div>
<?php endif; ?>

<form method="post" class="form-standard">
    <input type="text" name="full_name" placeholder="Full Name" value="<?= e($_POST['full_name'] ?? '') ?>" required>
    <input type="email" name="email" placeholder="Email" value="<?= e($_POST['email'] ?? '') ?>" required>
    <button type="submit">Add Instructor</button>
</form>

<?php include "../includes/footer.php"; ?>