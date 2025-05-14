<?php

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Fetch all items from the cart
$stmt = $conn->query("SELECT name, price, image FROM cart ORDER BY added_at DESC");
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Success - GoGalse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color:rgb(216, 223, 224);
        }

        .navbar {
            background-color: #085765;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .success-box {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .success-title {
            color: #28a745;
            font-weight: bold;
        }

        .list-group-item {
            border: none;
            border-bottom: 1px solid #eaeaea;
        }

        .item-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .thank-you {
            font-size: 1.1rem;
            color: #555;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">GoGalse</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="shop.php" class="nav-link">Shop</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="success-box mx-auto" style="max-width: 700px;">
        <h2 class="text-center success-title mb-3">Payment Successful!</h2>
        <?php if (count($cartItems) > 0): ?>
            <p class="thank-you text-center mb-4">Thank you for your purchase. Here are the items you bought:</p>
            <div class="list-group">
                <?php foreach ($cartItems as $item): ?>
                    <div class="list-group-item d-flex align-items-center">
                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="item-img me-3">
                        <div>
                            <h6 class="mb-1"><?= htmlspecialchars($item['name']) ?></h6>
                            <small class="text-muted">Price: $<?= number_format($item['price'], 2) ?></small>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-danger mt-4">No items found in your cart.</p>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
