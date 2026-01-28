<?php
require "../config/db.php";
include "../includes/header.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and execute insert query
    $stmt = $pdo->prepare(
        "INSERT INTO student_enrollment (name, email, course, year) VALUES (?, ?, ?, ?)"
    );
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['course'],
        $_POST['year']
    ]);

    // Redirect to index after adding
    header("Location: index.php");
    exit;
}
?>

<h2>Add New Student</h2>

<form method="POST">
    <label>Name:</label>
    <input type="text" name="name" required><br><br>

    <label>Email:</label>
    <input type="email" name="email" required><br><br>

    <label>Course:</label>
    <input type="text" name="course" required><br><br>

    <label>Year:</label>
    <input type="number" name="year" required><br><br>

    <button type="submit">Add Student</button>
</form>

<?php include "../includes/footer.php"; ?>
