<?php
require_once "../config/auth.php";
require_once "../config/db.php";
include "../includes/header.php";

$id = (int)($_GET['id'] ?? 0);

$stmt = $conn->prepare("SELECT * FROM instructors WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$instructor = $stmt->get_result()->fetch_assoc();

if (!$instructor) {
    echo "<div class='container'><p>Instructor not found.</p></div>";
    include "../includes/footer.php";
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $expertise = trim($_POST['expertise']);

    if (!$name) {
        $error = "Full Name is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Enter a valid email.";
    } else {
        $update = $conn->prepare(
            "UPDATE instructors SET full_name=?, email=?, expertise=? WHERE id=?"
        );
        $update->bind_param("sssi", $name, $email, $expertise, $id);
        $update->execute();

        header("Location: instructors.php");
        exit;
    }
}
?>

<div class="container">
    <h2>Edit Instructor</h2>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" class="edit-instructor">
        <input type="text" name="full_name" placeholder="Full Name"
               value="<?= htmlspecialchars($instructor['full_name']) ?>" required>

        <input type="email" name="email" placeholder="Email"
               value="<?= htmlspecialchars($instructor['email']) ?>" required>

        <input type="text" name="expertise" placeholder="Expertise"
               value="<?= htmlspecialchars($instructor['expertise']) ?>">

        <button type="submit">Update Instructor</button>
    </form>
</div>

<?php include "../includes/footer.php"; ?>
