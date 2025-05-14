<?php
$host = "127.0.0.1";        // or you can also use "localhost"
$dbname = "gogalse";        // your database name from phpMyAdmin
$user = "root";             // default user in XAMPP/WAMP
$password = "";             // default password is empty

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
