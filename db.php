<?php
$host = "127.0.0.1";  // or use "localhost"
$dbname = "gogalse";
$user = "root";
$password = "";       // Default is blank for XAMPP

try {
    $conn = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8mb4", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
