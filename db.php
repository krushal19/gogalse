<?php
$host = "gogalse"; // Caution: only works if MySQL is installed and listening
$dbname = "gogalse";
$user = "root";
$password = ""; // Must match the DB user's password

try {
    $conn = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8mb4", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
