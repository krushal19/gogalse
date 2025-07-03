<?php
// Show errors for debugging (you can remove this in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// STEP 1: Define database credentials
$host = 'localhost';
$dbname = 'gogalse';     // Replace with your actual database name
$user = 'root';          // Default XAMPP user
$password = '';          // Default password is empty in XAMPP

// STEP 2: Try to connect using PDO
try {
    // Data Source Name (DSN)
    $dsn = "mysql:host=$host;dbname=$dbname";

    // Create a PDO instance
    $conn = new PDO($dsn, $user, $password);

    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Success message
    echo "✅ Connected to database successfully!";
} catch (PDOException $e) {
    // Handle connection failure
    die("❌ Database connection failed: " . $e->getMessage());
}
?>
