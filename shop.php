
// require_once "db.php";

// // Establishing database connection with timeout handling
// try {
//     // Set the timeout to 30 seconds (adjust as needed)
//     $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password, [
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//         PDO::ATTR_TIMEOUT => 30  // 30 seconds timeout
//     ]);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die("Connection failed: " . $e->getMessage());
// }

// // Fetch products
// $stmt = $conn->query("SELECT * FROM products");
// $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// // Handle Add to Cart
// if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['product_id'])) {
//     $productId = $_POST['product_id'];

//     // Fetch product details
//     $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
//     $stmt->execute(['id' => $productId]);
//     $product = $stmt->fetch(PDO::FETCH_ASSOC);

//     if ($product) {
//         // Insert into cart table (create it if not exists)
//         $cartStmt = $conn->prepare("INSERT INTO cart (product_id, name, price, image) VALUES (:id, :name, :price, :image)");
//         $cartStmt->execute([
//             'id' => $product['id'],
//             'name' => $product['name'],
//             'price' => $product['price'],
//             'image' => $product['image']
//         ]);
//     }
//     header("Location: shop.php?type=" . urlencode($_GET['type'] ?? '') . "&company=" . urlencode($_GET['company'] ?? ''));
//     exit;
// }

// // Filters
// $type = $_GET['type'] ?? '';
// $company = $_GET['company'] ?? '';

// // Build Query for filtering products
// $query = "SELECT * FROM products WHERE 1=1";
// $params = [];

// if ($type) {
//     $query .= " AND type = :type";
//     $params['type'] = $type;
// }
// if ($company) {
//     $query .= " AND company = :company";
//     $params['company'] = $company;
// }

// $stmt = $conn->prepare($query);
// $stmt->execute($params);
// $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// // Get filter values for Types and Companies
// $types = $conn->query("SELECT DISTINCT type FROM products")->fetchAll(PDO::FETCH_COLUMN);
// $companies = $conn->query("SELECT DISTINCT company FROM products")->fetchAll(PDO::FETCH_COLUMN);


<?php
require_once "db.php"; // Make sure db.php has $host, $dbname, $user, $password

// Establishing database connection with timeout handling
try {
    // Set the timeout to 30 seconds (adjust as needed)
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 30 // 30 seconds timeout
    ]);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Handle Add to Cart
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // Fetch product details
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->execute(['id' => $productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        // Insert into cart table (you must create the 'cart' table if it doesn't exist)
        $cartStmt = $conn->prepare("INSERT INTO cart (product_id, name, price, image) VALUES (:id, :name, :price, :image)");
        $cartStmt->execute([
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'image' => $product['image']
        ]);
    }

    // Redirect to avoid form resubmission
    header("Location: shop.php?type=" . urlencode($_GET['type'] ?? '') . "&company=" . urlencode($_GET['company'] ?? ''));
    exit;
}

// Filters
$type = $_GET['type'] ?? '';
$company = $_GET['company'] ?? '';

// Build Query for filtering products
$query = "SELECT * FROM products WHERE 1=1";
$params = [];

if ($type) {
    $query .= " AND type = :type";
    $params['type'] = $type;
}

if ($company) {
    $query .= " AND company = :company";
    $params['company'] = $company;
}

$stmt = $conn->prepare($query);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get filter values for Types and Companies
$types = $conn->query("SELECT DISTINCT type FROM products")->fetchAll(PDO::FETCH_COLUMN);
$companies = $conn->query("SELECT DISTINCT company FROM products")->fetchAll(PDO::FETCH_COLUMN);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GoGalse Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top { height: 200px; object-fit: cover; }
        .sidebar { background-color: rgba(6, 72, 96, 0.76); padding: 20px; border-radius: 8px; color: rgba(235, 238, 239, 0.96); }
        .card:hover { transform: scale(1.02); transition: 0.3s; }
    </style>
</head>
<body style="background-color: rgb(8, 87, 101);">

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
                <li class="nav-item"><a href="shop.php" class="nav-link active">Shop</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                <li class="nav-item"><a href="cart.php" class="nav-link">Cart</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container-fluid mt-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="sidebar">
                <h5>Filter by Type</h5>
                <form method="GET">
                    <?php foreach ($types as $typeOption): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" value="<?= htmlspecialchars($typeOption) ?>" <?= $type == $typeOption ? 'checked' : '' ?> onchange="this.form.submit()">
                            <label class="form-check-label"><?= htmlspecialchars($typeOption) ?></label>
                        </div>
                    <?php endforeach; ?>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="type" value="" <?= $type == '' ? 'checked' : '' ?> onchange="this.form.submit()">
                        <label class="form-check-label">All Types</label>
                    </div>
                    <hr>
                    <h5>Filter by Company</h5>
                    <?php foreach ($companies as $companyOption): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="company" value="<?= htmlspecialchars($companyOption) ?>" <?= $company == $companyOption ? 'checked' : '' ?> onchange="this.form.submit()">
                            <label class="form-check-label"><?= htmlspecialchars($companyOption) ?></label>
                        </div>
                    <?php endforeach; ?>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="company" value="" <?= $company == '' ? 'checked' : '' ?> onchange="this.form.submit()">
                        <label class="form-check-label">All Companies</label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Products -->
        <div class="col-md-9">
            <div class="row g-4">
                <?php if ($products): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-sm-6 col-lg-4">
                            <div class="card h-100 shadow-sm">
                                <img src="<?= htmlspecialchars($product['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                                    <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                                    <div class="mt-auto">
                                        <p class="fw-bold">$<?= number_format($product['price'], 2) ?></p>
                                        <form method="POST" class="d-grid">
                                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                            <button type="submit" class="btn btn-outline-primary">Add to Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p class="text-muted">No products found matching filters.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer style="background-color: #085765; color: white; padding: 20px 0; text-align: center;">
    <p>&copy; 2025 GoGalse | 
       <a href="shop.php" style="color: #fff;">Home</a> | 
       <a href="cart.php" style="color: #fff;">Cart</a> | 
       <a href="contact.php" style="color: #fff;">Contact</a>
    </p>
    <p>Follow Us: 
       <a href="#" style="color: #fff;">Facebook</a> | 
       <a href="#" style="color: #fff;">Instagram</a> | 
       <a href="#" style="color: #fff;">Twitter</a>
    </p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
