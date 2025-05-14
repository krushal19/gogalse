<?php
$host = "127.0.0.1";
$dbname = "gogalse";
$user = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Connected successfully to '$dbname'";
} catch (PDOException $e) {
    die("❌ Connection failed: " . $e->getMessage());
}
