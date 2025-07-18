<?php
require_once "db.php"; // your db connection

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Get selected frame if already chosen
$selectedFrameId = $_GET['selected_frame_id'] ?? '';
$selectedFrameName = $_GET['selected_frame_name'] ?? '';

// Fetch products
$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recover Requirement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
<!-- Navbar -->
<?php include "head.php"; ?>

<div class="container mt-4">
    <h2 style="color: #ffffff;">Recovery Request Form</h2>
    <form method="POST" action="save_recover.php" style="color: #ffffff;">
        <div class="mb-3">
            <label>User Name</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mobile Number</label>
            <input type="text" name="mobile" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Gmail</label>
            <input type="email" name="gmail" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Left Lens Number</label>
            <input type="text" name="left_lens_number" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Right Lens Number</label>
            <input type="text" name="right_lens_number" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Selected Frame</label>
            <input type="text"  name="selected_frame_name" value="<?= htmlspecialchars($selectedFrameName) ?>"  class="form-control" readonly>
            <input type="hidden" name="selected_frame_id" value="<?= htmlspecialchars($selectedFrameId) ?>">
        </div>

        <div class="mb-3">
            <label>Notes (Optional)</label>
            <textarea name="notes" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Request</button>
    </form>

    <hr>
    <h4>Select Frame from Shop</h4>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="<?= htmlspecialchars($product['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                        <p class="fw-bold">₹<?= number_format($product['price'], 2) ?></p>
                        <a href="recover.php?selected_frame_id=<?= $product['id'] ?>&selected_frame_name=<?= urlencode($product['name']) ?>" class="btn btn-success">Select This Frame</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Footer -->
<?php include "footar.php"; ?>
</body>
</html>
