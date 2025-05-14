<?php
require_once "db.php";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Remove item from cart
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['remove_id'])) {
    $removeId = $_POST['remove_id'];

    // Delete from cart
    $stmt = $conn->prepare("DELETE FROM cart WHERE id = :id");
    $stmt->execute(['id' => $removeId]);
    header("Location: cart.php"); // Refresh the page
    exit;
}

// Fetch cart items
$stmt = $conn->query("SELECT * FROM cart");
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate total price
$totalPrice = 0;
foreach ($cartItems as $item) {
    $totalPrice += $item['price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GoGalse Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top { height: 150px; object-fit: cover; }
        .cart-item { display: flex; align-items: center; justify-content: space-between; }
        .cart-item img { width: 60px; height: 60px; object-fit: cover; }
        .cart-item .details { flex-grow: 1; padding-left: 10px; }
    </style>
</head>
<body style="background-color:rgba(6, 72, 96, 0.89);">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">GoGalse</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="shop.php" class="nav-link">Shop</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Cart Content -->
<div class="container mt-4">
    <h2 style="color:rgba(233, 238, 239, 0.99);">Your Shopping Cart</h2>

    <?php if ($cartItems): ?>
        <div class="list-group">
            <?php foreach ($cartItems as $item): ?>
                <div class="cart-item list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="img-fluid rounded">
                        <div class="details">
                            <h5 class="mb-1"><?= htmlspecialchars($item['name']) ?></h5>
                            <p class="mb-1">Price: $<?= number_format($item['price'], 2) ?></p>
                        </div>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="remove_id" value="<?= $item['id'] ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-4 d-flex justify-content-between" style="color:rgba(242, 249, 252, 0.99);">
            <h3>Total: $<?= number_format($totalPrice, 2) ?></h3>
            <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
        </div>
    <?php else: ?>
        <p style="background-color:rgba(236, 239, 240, 0.76);">Your cart is empty.</p>
    <?php endif; ?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
