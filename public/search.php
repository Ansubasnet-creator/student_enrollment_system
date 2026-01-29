<?php
require "../config/db.php";

$q="%".$_GET['q']."%";

$stmt=$pdo->prepare(
 "SELECT * FROM student_enrollment
  WHERE name LIKE ? OR course LIKE ? LIMIT 5"
);
$stmt->execute([$q,$q]);

foreach($stmt as $r){
 echo "<p>{$r['name']} - {$r['course']}</p>";
}
