<?php
require "../config/db.php";
require "../includes/functions.php";
check_login();
include "../includes/header.php";

if($_POST){
 $pdo->prepare(
  "INSERT INTO grades(student_id,subject,grade)
   VALUES(?,?,?)"
 )->execute([$_POST['student'],$_POST['subject'],$_POST['grade']]);
}

$students=$pdo->query("SELECT * FROM student_enrollment")->fetchAll();
?>

<form method="POST">
<select name="student">
<?php foreach($students as $s): ?>
<option value="<?=$s['id']?>"><?=$s['name']?></option>
<?php endforeach;?>
</select>

Subject:<input name="subject">
Grade:<input name="grade">
<button>Save</button>
</form>

<?php include "../includes/footer.php"; ?>
