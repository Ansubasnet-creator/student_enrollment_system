<?php
require "../config/db.php";
session_start();

if($_POST){
    $stmt=$pdo->prepare("SELECT * FROM admins WHERE username=?");
    $stmt->execute([$_POST['username']]);
    $a=$stmt->fetch();

    if($a && password_verify($_POST['password'],$a['password'])){
        $_SESSION['admin']=true;
        header("Location: index.php");
        exit;
    }
    echo "Login failed";
}
?>

<form method="POST">
Username: <input name="username"><br>
Password: <input type="password" name="password"><br>
<button>Login</button>
</form>
