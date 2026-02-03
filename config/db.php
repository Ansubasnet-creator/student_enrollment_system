<?php
$servername = "localhost";
$username = "np03cs4a240353";
$password = "35266ansu";
$dbname = "np03cs4a240353"; // ✅ correct DB name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>