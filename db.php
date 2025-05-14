<?php
$host = "127.0.0.1";       // Use "localhost" for XAMPP
$dbname = "gogalse";       // Your actual database name
$user = "root";            // Default XAMPP username
$password = "";            // Default XAMPP password is blank

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
