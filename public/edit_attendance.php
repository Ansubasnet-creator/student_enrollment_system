<?php
require_once "../config/auth.php";
require_once "../config/db.php";
include "../includes/header.php";

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM attendance WHERE id=$id")->fetch_assoc();
$students = $conn->query("SELECT id, name FROM students");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $conn->prepare(
        "UPDATE attendance SET student_id=?, date=?, status=? WHERE id=?"
    );
    $stmt->bind_param("issi", $_POST['student_id'], $_POST['date'], $_POST['status'], $id);
    $stmt->execute();
    header("Location: attendences.php");
    exit;
}
?>

<h2>Edit Attendance</h2>

<form method="post">
    <select name="student_id">
        <?php while ($s = $students->fetch_assoc()): ?>
            <option value="<?= $s['id'] ?>" <?= $s['id']==$data['student_id']?'selected':'' ?>>
                <?= $s['name'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <input type="date" name="date" value="<?= $data['date'] ?>" required>

    <select name="status">
        <option <?= $data['status']=="Present"?'selected':'' ?>>Present</option>
        <option <?= $data['status']=="Absent"?'selected':'' ?>>Absent</option>
    </select>

    <button type="submit">Update</button>
</form>

<?php include "../includes/footer.php"; ?>
