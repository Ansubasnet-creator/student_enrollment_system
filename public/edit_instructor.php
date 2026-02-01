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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $expertise = $_POST['expertise'];

    $update = $conn->prepare("UPDATE instructors SET full_name=?, email=?, expertise=? WHERE id=?");
    $update->bind_param("sssi", $name, $email, $expertise, $id);
    $update->execute();

    header("Location: instructors.php");
    exit;
}
?>

<div class="container">
    <h2>Edit Instructor</h2>
    <form method="post">
        <label>Full Name</label>
        <input type="text" name="full_name" value="<?= e($instructor['full_name']) ?>" required>
        <label>Email</label>
        <input type="email" name="email" value="<?= e($instructor['email']) ?>" required>
        <label>Expertise</label>
        <input type="text" name="expertise" value="<?= e($instructor['expertise']) ?>">
        <button class="btn" type="submit">Update Instructor</button>
    </form>
</div>

<?php include "../includes/footer.php"; ?>
