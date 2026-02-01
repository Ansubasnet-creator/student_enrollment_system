<?php
require_once "../config/auth.php";
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $expertise = trim($_POST['expertise']);

    if (!$full_name || !preg_match("/^[a-zA-Z\s]+$/", $full_name)) {
        $error = "Enter valid name (letters only).";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Enter valid email.";
    } elseif (!$expertise) {
        $error = "Expertise is required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO instructors (full_name, email, expertise) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $full_name, $email, $expertise);
        $stmt->execute();
        header("Location: instructors.php");
        exit;
    }
}
?>

<h2>Add Instructor</h2>
<?php if ($error): ?><div class="error"><?= e($error) ?></div><?php endif; ?>

<form method="post">
    <input type="text" name="full_name" placeholder="Full Name" value="<?= e($_POST['full_name'] ?? '') ?>" required>
    <input type="email" name="email" placeholder="Email" value="<?= e($_POST['email'] ?? '') ?>" required>
    <input type="text" name="expertise" placeholder="Expertise" value="<?= e($_POST['expertise'] ?? '') ?>" required>
    <button type="submit">Add Instructor</button>
</form>

<?php include "../includes/footer.php"; ?>
