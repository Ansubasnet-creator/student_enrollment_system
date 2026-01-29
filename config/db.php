<?php
$pdo = new PDO("mysql:host=localhost;dbname=student","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
