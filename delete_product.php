<?php
require_once "db.php"; // Make sure db.php has $host, $dbname, $user, $password
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if ID is provided
$id = $_GET['id'] ?? null;
if (!$id) {
    die("❌ Invalid product ID.");
}

// Fetch product to get image path
$stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("❌ Product not found.");
}

// Delete image if exists
$imagePath = $product['image'];
if ($imagePath && file_exists($imagePath)) {
    unlink($imagePath);
}

// Delete product from database
$stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

// Redirect after deletion
header("Location: seller.php?msg=deleted");
exit;
?>
