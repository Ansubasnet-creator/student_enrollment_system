<?php
require "db.php";

if($_POST){
    $pdo->prepare("INSERT INTO students(name,email) VALUES(?,?)")
        ->execute([$_POST['name'],$_POST['email']]);
}

$students = $pdo->query("SELECT * FROM students")->fetchAll();
?>

<h2>Student Enrollment</h2>

<form method="POST">
Name: <input name="name"><br>
Email: <input name="email"><br>
<button>Add Student</button>
</form>

<hr>

<h3>Students List</h3>

<?php foreach($students as $s): ?>
<p><?= $s['name'] ?> - <?= $s['email'] ?></p>
<?php endforeach; ?>
