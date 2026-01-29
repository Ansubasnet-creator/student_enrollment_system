<?php
require "../config/db.php";
require "../includes/functions.php";
check_login();

if($_POST){
    verify_csrf();

    if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
        die("Invalid email");

    $stmt=$pdo->prepare(
        "INSERT INTO student_enrollment(name,email,course,year)
         VALUES(?,?,?,?)"
    );
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['course'],
        $_POST['year']
    ]);

    header("Location:index.php");
}

include "../includes/header.php";
?>

<form method="POST">
<input type="hidden" name="csrf" value="<?=csrf()?>">

Name:<input name="name" required>
Email:<input name="email" required>
Course:<input name="course" required>
Year:<input name="year" required>

<button>Add</button>
</form>

<?php include "../includes/footer.php"; ?>
