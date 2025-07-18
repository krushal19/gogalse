<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Include database connection
require_once 'db.php';

$user_id = $_SESSION['user_id']; // Store user_id from session

$successMsg = $errorMsg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name'], $_POST['type'], $_POST['company'], $_POST['price'], $_POST['description'], $_FILES['image'])) {
        $name = $_POST['name'];
        $type = $_POST['type'];
        $company = $_POST['company'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        if ($_FILES['image']['error'] == 0) {
            $imageDir = 'gogalse/images/';
            if (!is_dir($imageDir)) mkdir($imageDir, 0777, true);

            $uniqueName = uniqid() . "_" . basename($_FILES['image']['name']);
            $imageFile = $imageDir . $uniqueName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $imageFile)) {
                $stmt = $conn->prepare("INSERT INTO products (name, type, company, image, price, description, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$name, $type, $company, $imageFile, $price, $description, $user_id]);
                $successMsg = "✅ Product inserted successfully!";
            } else {
                $errorMsg = "❌ Image upload failed.";
            }
        } else {
            $errorMsg = "❌ No image uploaded or upload error.";
        }
    } else {
        $errorMsg = "❌ All fields are required.";
    }
}

// Fetch filters (for this seller's products only)
$types = $conn->prepare("SELECT DISTINCT type FROM products WHERE user_id = ?");
$types->execute([$user_id]);
$types = $types->fetchAll(PDO::FETCH_COLUMN);

$companies = $conn->prepare("SELECT DISTINCT company FROM products WHERE user_id = ?");
$companies->execute([$user_id]);
$companies = $companies->fetchAll(PDO::FETCH_COLUMN);

// Filter logic
$type = $_GET['type'] ?? '';
$company = $_GET['company'] ?? '';

$query = "SELECT * FROM products WHERE user_id = :user_id";
$params = [':user_id' => $user_id];

if ($type) {
    $query .= " AND type = :type";
    $params[':type'] = $type;
}
if ($company) {
    $query .= " AND company = :company";
    $params[':company'] = $company;
}

$stmt = $conn->prepare($query);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>GoGalse - Seller Product Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f2f2f2; }
        .form-container {
            max-width: 700px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 0px 12px rgba(0,0,0,0.1);
        }
        .card-img-top { height: 200px; object-fit: cover; }
        .card:hover { transform: scale(1.02); transition: 0.3s; }
        .sidebar { background-color: #f8f9fa; padding: 20px; border-radius: 8px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">GoGalse</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="register.php" class="nav-link">Register</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="form-container">
        <h2 class="text-center mb-4">📦 Add New Product</h2>

        <?php if ($successMsg): ?>
            <div class="alert alert-success"><?= htmlspecialchars($successMsg) ?></div>
        <?php endif; ?>
        <?php if ($errorMsg): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($errorMsg) ?></div>
        <?php endif; ?>

        <form action="seller.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Type</label>
                <select name="type" class="form-select" required>
                    <option value="">Select Type</option>
                    <option value="1 Sun GoGalse">1 Sun GoGalse</option>
                    <option value="2 Num GoGalse">2 Num GoGalse</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Company</label>
                <select name="company" class="form-select" required>
                    <option value="">Select Company</option>
                    <option value="Ray-Ban">Ray-Ban</option>
                    <option value="Oakley">Oakley</option>
                    <option value="Gucci">Gucci</option>
                    <option value="Armani">Armani</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Image</label>
                <input type="file" name="image" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Price ($)</label>
                <input type="number" name="price" step="0.01" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4" required></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Upload Product</button>
            </div>
        </form>
    </div>

    <div class="row mt-5">
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

        <div class="col-md-9">
            <div class="row g-4">
                <?php if ($products): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-sm-6 col-lg-4">
                            <div class="card h-100 shadow-sm">
                                <img src="<?= htmlspecialchars($product['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                                    <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                                    <p class="card-text"><strong>$<?= number_format($product['price'], 2) ?></strong></p>
                                    <div class="d-flex justify-content-between mt-3">
                                        <a href="edit_product.php?id=<?= $product['id'] ?>" class="btn btn-warning btn-sm">✏️ Edit</a>
                                        <a href="delete_product.php?id=<?= $product['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">🗑️ Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No products found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include "footar.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
