<?php
// db_connect.php
$host = 'srv1535.hstgr.io';
$db   = 'u244407333_school';
$user = 'u244407333_schoolun';
$pass = 'B.3ZgjqbUD%/4gk';
$charset = 'utf8mb4';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
$conn->set_charset($charset);
?>