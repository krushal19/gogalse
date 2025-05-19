<?php
$host = "localhost";
$user = "root";
$password = ""; // default password is empty for XAMPP
$dbname = "gogalse"; // or whatever your local DB is

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
