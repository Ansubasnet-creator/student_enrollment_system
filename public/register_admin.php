<?php
session_start();
require_once '../config/db.php';
require_once '../includes/functions.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['csrf_token']) || !validate_csrf_token($_POST['csrf_token'])) {
        die("CSRF token validation failed");
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "All fields are required.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            $success = "Admin registered successfully.";
        } else {
            $error = "Error registering admin. Username may already exist.";
        }
    }
}

$csrf_token = generate_csrf_token();
?>

<link rel="stylesheet" href="../assets/css/style.css">

<div class="login-box">
    <h2>Register Admin</h2>
    <?php if ($error) echo "<p class='error'>".sanitize_output($error)."</p>"; ?>
    <?php if ($success) echo "<p class='success'>".sanitize_output($success)."</p>"; ?>
    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <label>Username</label>
        <input type="text" name="username" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Register</button>
    </form>
</div>
