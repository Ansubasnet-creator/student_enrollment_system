<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include("../config/db.php");

$id = $_GET['id'];
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $sql = "UPDATE students SET name=?, email=?, course=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $course, $id);
    if ($stmt->execute()) {
        header("Location: students.php");
        exit;
    } else {
        $error = "Error updating student.";
    }
}
?>
<?php include("../includes/header.php"); ?>
<div class="form-box">
    <h2>Edit Student</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="name" value="<?php echo $student['name']; ?>" required>
        <input type="email" name="email" value="<?php echo $student['email']; ?>" required>
        <input type="text" name="course" value="<?php echo $student['course']; ?>" required>
        <button type="submit">Update</button>
    </form>
    <a href="students.php" class="btn">Back</a>
</div>
<?php include("../includes/footer.php"); ?>