<?php
session_start();
include __DIR__ . '/../config/db.php';
include __DIR__ . '/../includes/functions.php';
include __DIR__ . '/../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || !validate_csrf_token($_POST['csrf_token'])) {
        die("CSRF token validation failed");
    }

    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    if (!validate_email($email)) {
        $error = "Invalid email format.";
    } else {
        $stmt = $conn->prepare("INSERT INTO admins (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $password);
        if ($stmt->execute()) {
            $success = "Admin registered successfully.";
        } else {
            $error = "Error registering admin.";
        }
    }
}

$csrf_token = generate_csrf_token();
?>
<div class="login-box">
    <h2>Register Admin</h2>
    <?php if (!empty($error)) echo "<p class='error'>".sanitize_output($error)."</p>"; ?>
    <?php if (!empty($success)) echo "<p class='success'>".sanitize_output($success)."</p>"; ?>
    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <label>Email</label>
        <input type="email" name="email" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Register</button>
    </form>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>