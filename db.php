<?php
$host = "sql204.infinityfree.com";
$user = "if0_38996043";
$password = "MyStrongPass123"; // <-- this is your real password
$database = "if0_38996043_gogalse";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
