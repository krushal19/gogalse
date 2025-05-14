<?php

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$id = $_GET['id'] ?? null;
if (!$id) die("Invalid ID");

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) die("Product not found");

$successMsg = $errorMsg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $company = $_POST['company'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $imagePath = $product['image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageDir = 'gogalse/images/';
        if (!is_dir($imageDir)) mkdir($imageDir, 0777, true);
        $newImage = $imageDir . basename($_FILES['image']['name']);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $newImage)) {
            if (file_exists($imagePath)) unlink($imagePath);
            $imagePath = $newImage;
        } else {
            $errorMsg = "❌ Failed to upload new image.";
        }
    }

    $stmt = $conn->prepare("UPDATE products SET name = ?, type = ?, company = ?, price = ?, description = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $type, $company, $price, $description, $imagePath, $id]);

    $successMsg = "✅ Product updated successfully!";
    header("Location: seller.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product - GoGalse</title>
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
        img.preview {
            width: 150px;
            height: auto;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
    </style>
</head>
<body>

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

<div class="container">
    <div class="form-container">
        <h2 class="text-center mb-4">✏️ Edit Product</h2>

        <?php if ($errorMsg): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($errorMsg) ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Type</label>
                <select name="type" class="form-select" required>
                    <option value="1 Sun GoGalse" <?= $product['type'] == '1 Sun GoGalse' ? 'selected' : '' ?>>1 Sun GoGalse</option>
                    <option value="2 Num GoGalse" <?= $product['type'] == '2 Num GoGalse' ? 'selected' : '' ?>>2 Num GoGalse</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Company</label>
                <select name="company" class="form-select" required>
                    <option value="Ray-Ban" <?= $product['company'] == 'Ray-Ban' ? 'selected' : '' ?>>Ray-Ban</option>
                    <option value="Oakley" <?= $product['company'] == 'Oakley' ? 'selected' : '' ?>>Oakley</option>
                    <option value="Gucci" <?= $product['company'] == 'Gucci' ? 'selected' : '' ?>>Gucci</option>
                    <option value="Armani" <?= $product['company'] == 'Armani' ? 'selected' : '' ?>>Armani</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Current Image</label><br>
                <img src="<?= htmlspecialchars($product['image']) ?>" class="preview" alt="Product Image">
            </div>

            <div class="mb-3">
                <label class="form-label">Change Image (optional)</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Price ($)</label>
                <input type="number" name="price" step="0.01" value="<?= htmlspecialchars($product['price']) ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4" required><?= htmlspecialchars($product['description']) ?></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Update Product</button>
                <a href="seller.php" class="btn btn-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
